<?php

namespace App\Jobs;

use App\Models\Recipe;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\RequestException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class FetchSpoonacularRecipes implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The maximum number of attempts.
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     */
    public int $timeout = 120;

    /**
     * The backoff strategy in seconds.
     *
     * @return array<int>
     */
    public function backoff(): array
    {
        return [1, 5, 10];
    }

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = (string) config('services.spoonacular.key');

        if ($apiKey === '') {
            Log::warning('Spoonacular sync skipped because API key is not configured.');

            return;
        }

        $endpoint = (string) config('services.spoonacular.endpoint', 'https://api.spoonacular.com/recipes/complexSearch');
        $defaultCount = max((int) config('services.spoonacular.default_count', 25), 1);
        $maxOffset = max((int) config('services.spoonacular.max_offset', 500), 0);
        $offset = $this->resolveAndAdvanceOffset($defaultCount, $maxOffset);

        $response = Http::acceptJson()
            ->connectTimeout(10)
            ->timeout(30)
            ->retry(3, 1000, throw: false)
            ->get($endpoint, [
                'apiKey' => $apiKey,
                'number' => $defaultCount,
                'offset' => $offset,
                'addRecipeInformation' => true,
                'addRecipeNutrition' => true,
            ]);

        if ($response->status() === 402) {
            Log::warning('Spoonacular sync skipped because daily quota is exhausted.', [
                'quota_left' => $response->header('x-api-quota-left'),
                'quota_used' => $response->header('x-api-quota-used'),
            ]);

            return;
        }

        $response->throw();

        $results = $response->json('results', []);

        if (! is_array($results) || $results === []) {
            Log::info('Spoonacular sync completed with no recipes returned.');

            return;
        }

        $incomingIds = [];

        foreach ($results as $recipe) {
            if (! is_array($recipe) || ! isset($recipe['id'])) {
                continue;
            }

            $incomingIds[] = (string) $recipe['id'];
        }

        $existingRecipes = Recipe::query()
            ->whereIn('spoonacular_id', $incomingIds)
            ->get()
            ->keyBy('spoonacular_id');

        $now = now();
        $rows = [];

        foreach ($results as $recipe) {
            if (! is_array($recipe) || ! isset($recipe['id'], $recipe['title'])) {
                continue;
            }

            $hydratedRecipe = $this->hydrateRecipeIfNeeded($recipe, $apiKey);
            $existing = $existingRecipes->get((string) $hydratedRecipe['id']);

            $protein = $this->extractNutrient($hydratedRecipe, 'protein');
            $fat = $this->extractNutrient($hydratedRecipe, 'fat');

            $summary = trim((string) ($hydratedRecipe['summary'] ?? ''));
            $instructions = $this->extractInstructions($hydratedRecipe);
            $calories = $this->extractCalories($hydratedRecipe);
            $dishTypes = array_values(array_filter((array) ($hydratedRecipe['dishTypes'] ?? []), 'is_string'));
            $diets = array_values(array_filter((array) ($hydratedRecipe['diets'] ?? []), 'is_string'));

            if ($existing instanceof Recipe) {
                if ($summary === '') {
                    $summary = (string) ($existing->summary ?? '');
                }

                if ($instructions === null || trim($instructions) === '') {
                    $existingInstructions = (string) ($existing->instructions ?? '');
                    $instructions = trim($existingInstructions) !== '' ? $existingInstructions : null;
                }

                if ($calories === null) {
                    $calories = is_numeric($existing->calories) ? (int) $existing->calories : null;
                }

                if ($dishTypes === []) {
                    $dishTypes = is_array($existing->dish_types) ? $existing->dish_types : [];
                }

                if ($diets === []) {
                    $diets = is_array($existing->diets) ? $existing->diets : [];
                }

                if ($protein['amount'] === null && $existing->protein !== null) {
                    $protein['amount'] = (float) $existing->protein;
                }

                if ($protein['unit'] === null && filled($existing->protein_unit)) {
                    $protein['unit'] = (string) $existing->protein_unit;
                }

                if ($fat['amount'] === null && $existing->fat !== null) {
                    $fat['amount'] = (float) $existing->fat;
                }

                if ($fat['unit'] === null && filled($existing->fat_unit)) {
                    $fat['unit'] = (string) $existing->fat_unit;
                }
            }

            $rows[] = [
                'spoonacular_id' => (string) $hydratedRecipe['id'],
                'title' => (string) $hydratedRecipe['title'],
                'image' => (string) ($hydratedRecipe['image'] ?? ''),
                'summary' => $summary,
                'instructions' => $instructions,
                'ready_in_minutes' => (int) ($hydratedRecipe['readyInMinutes'] ?? 0),
                'servings' => (int) ($hydratedRecipe['servings'] ?? 0),
                'calories' => $calories,
                'dish_types' => json_encode($dishTypes),
                'diets' => json_encode($diets),
                'protein' => $protein['amount'],
                'protein_unit' => $protein['unit'],
                'fat' => $fat['amount'],
                'fat_unit' => $fat['unit'],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }

        if ($rows === []) {
            Log::info('Spoonacular sync completed with no valid recipes to upsert.');

            return;
        }

        Recipe::query()->upsert(
            $rows,
            ['spoonacular_id'],
            ['title', 'image', 'summary', 'instructions', 'ready_in_minutes', 'servings', 'calories', 'dish_types', 'diets', 'protein', 'protein_unit', 'fat', 'fat_unit', 'updated_at']
        );

        Log::info('Spoonacular recipe sync completed.', [
            'count' => count($rows),
            'offset' => $offset,
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        $context = ['message' => $exception->getMessage()];

        if ($exception instanceof RequestException && $exception->response !== null) {
            $context['status'] = $exception->response->status();
        }

        Log::error('Spoonacular recipe sync failed.', $context);
    }

    /**
     * Extract a named nutrient's amount and unit from the Spoonacular nutrition payload.
     *
     * @param  array<string, mixed>  $recipe
     * @return array{amount: ?float, unit: ?string}
     */
    private function extractNutrient(array $recipe, string $name): array
    {
        $nutrition = $recipe['nutrition'] ?? null;

        if (! is_array($nutrition)) {
            return $this->extractNutrientFromSummary($recipe, $name);
        }

        $nutrients = $nutrition['nutrients'] ?? null;

        if (! is_array($nutrients)) {
            return $this->extractNutrientFromSummary($recipe, $name);
        }

        foreach ($nutrients as $nutrient) {
            if (! is_array($nutrient)) {
                continue;
            }

            if (strtolower((string) ($nutrient['name'] ?? '')) !== strtolower($name)) {
                continue;
            }

            if (! isset($nutrient['amount']) || ! is_numeric($nutrient['amount'])) {
                return ['amount' => null, 'unit' => null];
            }

            return [
                'amount' => round((float) $nutrient['amount'], 2),
                'unit' => isset($nutrient['unit']) ? (string) $nutrient['unit'] : null,
            ];
        }

        return $this->extractNutrientFromSummary($recipe, $name);
    }

    /**
     * Extract nutrient data from summary text when nutrition payload is missing.
     *
     * @param  array<string, mixed>  $recipe
     * @return array{amount: ?float, unit: ?string}
     */
    private function extractNutrientFromSummary(array $recipe, string $name): array
    {
        $summaryText = trim(strip_tags((string) ($recipe['summary'] ?? '')));

        if ($summaryText === '') {
            return ['amount' => null, 'unit' => null];
        }

        $quotedName = preg_quote($name, '/');

        if (! preg_match('/([0-9]+(?:\\.[0-9]+)?)\\s*(g|mg|mcg|µg)?\\s*(?:of\\s+)?'.$quotedName.'\\b/i', $summaryText, $matches)) {
            return ['amount' => null, 'unit' => null];
        }

        if (! is_numeric($matches[1])) {
            return ['amount' => null, 'unit' => null];
        }

        return [
            'amount' => round((float) $matches[1], 2),
            'unit' => isset($matches[2]) && $matches[2] !== '' ? strtolower((string) $matches[2]) : null,
        ];
    }

    /**
     * Hydrate a recipe with details when core fields are missing in complexSearch results.
     *
     * @param  array<string, mixed>  $recipe
     * @return array<string, mixed>
     */
    private function hydrateRecipeIfNeeded(array $recipe, string $apiKey): array
    {
        if (! $this->requiresHydration($recipe)) {
            return $recipe;
        }

        if (! isset($recipe['id'])) {
            return $recipe;
        }

        $recipeId = (string) $recipe['id'];

        try {
            $detailResponse = Http::acceptJson()
                ->connectTimeout(10)
                ->timeout(30)
                ->retry(2, 1000, throw: false)
                ->get("https://api.spoonacular.com/recipes/{$recipeId}/information", [
                    'apiKey' => $apiKey,
                    'includeNutrition' => true,
                ]);

            if (! $detailResponse->successful()) {
                if ($detailResponse->status() === 402) {
                    Log::warning('Spoonacular recipe detail hydration skipped due to quota exhaustion.', [
                        'recipe_id' => $recipeId,
                        'quota_left' => $detailResponse->header('x-api-quota-left'),
                        'quota_used' => $detailResponse->header('x-api-quota-used'),
                    ]);

                    return $recipe;
                }

                Log::warning('Spoonacular recipe detail hydration failed.', [
                    'recipe_id' => $recipeId,
                    'status' => $detailResponse->status(),
                ]);

                return $recipe;
            }

            $detailRecipe = $detailResponse->json();

            if (! is_array($detailRecipe) || $detailRecipe === []) {
                return $recipe;
            }

            return array_replace_recursive($recipe, $detailRecipe);
        } catch (Throwable $exception) {
            Log::warning('Spoonacular recipe detail hydration threw an exception.', [
                'recipe_id' => $recipeId,
                'message' => $exception->getMessage(),
            ]);

            return $recipe;
        }
    }

    /**
     * Decide whether we need the details endpoint for this recipe.
     *
     * @param  array<string, mixed>  $recipe
     */
    private function requiresHydration(array $recipe): bool
    {
        $hasInstructions = filled((string) ($recipe['instructions'] ?? ''));
        $hasDishTypes = is_array($recipe['dishTypes'] ?? null) && $recipe['dishTypes'] !== [];
        $hasDiets = is_array($recipe['diets'] ?? null) && $recipe['diets'] !== [];

        $nutrition = $recipe['nutrition'] ?? null;
        $hasNutrition = is_array($nutrition)
            && is_array($nutrition['nutrients'] ?? null)
            && ($nutrition['nutrients'] ?? []) !== [];

        return ! ($hasInstructions && $hasDishTypes && $hasDiets && $hasNutrition);
    }

    /**
     * Normalize instructions from either plain instructions or analyzed steps.
     *
     * @param  array<string, mixed>  $recipe
     */
    private function extractInstructions(array $recipe): ?string
    {
        $instructions = trim((string) ($recipe['instructions'] ?? ''));

        if ($instructions !== '') {
            return $instructions;
        }

        $analyzedInstructions = $recipe['analyzedInstructions'] ?? null;

        if (! is_array($analyzedInstructions) || $analyzedInstructions === []) {
            return null;
        }

        $steps = [];

        foreach ($analyzedInstructions as $section) {
            if (! is_array($section)) {
                continue;
            }

            $sectionSteps = $section['steps'] ?? null;

            if (! is_array($sectionSteps)) {
                continue;
            }

            foreach ($sectionSteps as $step) {
                if (! is_array($step)) {
                    continue;
                }

                $stepText = trim((string) ($step['step'] ?? ''));

                if ($stepText !== '') {
                    $steps[] = $stepText;
                }
            }
        }

        if ($steps === []) {
            return null;
        }

        return implode(PHP_EOL, $steps);
    }

    /**
     * Extract calories from Spoonacular nutrition payload.
     *
     * @param  array<string, mixed>  $recipe
     */
    private function extractCalories(array $recipe): ?int
    {
        $nutrition = $recipe['nutrition'] ?? null;

        if (! is_array($nutrition)) {
            return $this->extractCaloriesFromSummary($recipe);
        }

        $nutrients = $nutrition['nutrients'] ?? null;

        if (! is_array($nutrients)) {
            return $this->extractCaloriesFromSummary($recipe);
        }

        foreach ($nutrients as $nutrient) {
            if (! is_array($nutrient)) {
                continue;
            }

            $name = strtolower((string) ($nutrient['name'] ?? ''));

            if ($name !== 'calories') {
                continue;
            }

            if (! isset($nutrient['amount']) || ! is_numeric($nutrient['amount'])) {
                return null;
            }

            return (int) round((float) $nutrient['amount']);
        }

        return $this->extractCaloriesFromSummary($recipe);
    }

    /**
     * Extract calories from summary text when nutrition payload is missing.
     *
     * @param  array<string, mixed>  $recipe
     */
    private function extractCaloriesFromSummary(array $recipe): ?int
    {
        $summaryText = trim(strip_tags((string) ($recipe['summary'] ?? '')));

        if ($summaryText === '') {
            return null;
        }

        if (! preg_match('/([0-9]+(?:\\.[0-9]+)?)\\s*calories\\b/i', $summaryText, $matches)) {
            return null;
        }

        if (! is_numeric($matches[1])) {
            return null;
        }

        return (int) round((float) $matches[1]);
    }

    /**
     * Resolve current import offset and advance pointer for the next run.
     */
    private function resolveAndAdvanceOffset(int $batchSize, int $maxOffset): int
    {
        $offsetFile = storage_path('app/spoonacular-import-offset.txt');
        $offset = 0;

        if (is_file($offsetFile)) {
            $storedOffset = (int) trim((string) file_get_contents($offsetFile));
            $offset = max($storedOffset, 0);
        }

        if ($offset > $maxOffset) {
            $offset = 0;
        }

        $nextOffset = $offset + $batchSize;

        if ($nextOffset > $maxOffset) {
            $nextOffset = 0;
        }

        file_put_contents($offsetFile, (string) $nextOffset);

        return $offset;
    }
}
