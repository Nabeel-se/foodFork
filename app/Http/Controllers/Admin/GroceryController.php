<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GroceryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        if ($user === null) {
            abort(403);
        }

        $weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $plannerData = $this->weeklyPlannerData((int) $user->id, $weekStart);
        $weeklyEntries = $this->weeklyEntries($plannerData);
        $plannedRecipeIds = $weeklyEntries
            ->pluck('recipe_id')
            ->unique()
            ->values();

        $recipesBySpoonacularId = Recipe::query()
            ->whereIn('spoonacular_id', $plannedRecipeIds, 'and', false)
            ->get()
            ->keyBy('spoonacular_id');

        $groceryItems = $weeklyEntries
            ->flatMap(function (array $entry) use ($recipesBySpoonacularId): array {
                $recipe = $recipesBySpoonacularId->get($entry['recipe_id']);

                if (! $recipe instanceof Recipe) {
                    return [];
                }

                $multiplier = $this->servingMultiplier($recipe, $entry['servings']);

                return collect(is_array($recipe->ingredients) ? $recipe->ingredients : [])
                    ->map(fn (mixed $ingredient): ?array => $this->parseIngredientLine($ingredient, $multiplier, (string) $recipe->title))
                    ->filter()
                    ->values()
                    ->all();
            })
            ->groupBy('key')
            ->map(function (Collection $ingredients, string $key): array {
                $name = (string) $ingredients->first()['name'];
                $totalsByUnit = $ingredients
                    ->groupBy(fn (array $ingredient): string => (string) ($ingredient['unit'] ?? ''))
                    ->map(function (Collection $unitGroup, string $unit): string {
                        $knownQuantity = $unitGroup
                            ->pluck('quantity')
                            ->filter(static fn (mixed $quantity): bool => is_numeric($quantity))
                            ->sum();

                        $unknownQuantityCount = $unitGroup->filter(static fn (array $ingredient): bool => $ingredient['quantity'] === null)->count();
                        $parts = [];

                        if ($knownQuantity > 0) {
                            $parts[] = trim($this->formatQuantity((float) $knownQuantity).' '.($unit !== '' ? $unit : ''));
                        }

                        if ($unknownQuantityCount > 0) {
                            $parts[] = $unknownQuantityCount.' item'.($unknownQuantityCount === 1 ? '' : 's');
                        }

                        return implode(' + ', array_filter($parts));
                    })
                    ->filter(static fn (string $value): bool => $value !== '')
                    ->values();

                return [
                    'key' => $key,
                    'name' => $name,
                    'total' => $totalsByUnit->implode(', '),
                    'recipes' => $ingredients->pluck('recipe_title')->unique()->sort()->values()->all(),
                    'occurrences' => $ingredients->count(),
                ];
            })
            ->sortBy('name')
            ->values();

        return view('app.dashboard.grocery', [
            'title' => 'FoodFork - Grocery List',
            'active' => 'grocery',
            'topbarTitle' => 'Grocery List',
            'groceryItems' => $groceryItems,
            'plannedRecipesCount' => $plannedRecipeIds->count(),
            'weekStartLabel' => $weekStart->format('d M Y'),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function weeklyPlannerData(int $userId, Carbon $weekStart): array
    {
        $mealPlan = MealPlan::query()
            ->where('user_id', $userId)
            ->whereDate('week_start', $weekStart->toDateString())
            ->first();

        return is_array($mealPlan?->planner_data) ? $mealPlan->planner_data : [];
    }

    /**
     * @param  array<string, mixed>  $plannerData
     * @return Collection<int, array{recipe_id: string, servings: int}>
     */
    private function weeklyEntries(array $plannerData): Collection
    {
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $slots = ['breakfast', 'lunch', 'dinner'];

        return collect($days)
            ->flatMap(function (string $day) use ($plannerData, $slots): Collection {
                return collect($slots)->map(function (string $slot) use ($plannerData, $day): array {
                    $entry = data_get($plannerData, $day.'-'.$slot, []);

                    return [
                        'recipe_id' => trim((string) data_get($entry, 'recipeId', '')),
                        'servings' => max((int) data_get($entry, 'servings', 1), 1),
                    ];
                });
            })
            ->filter(static fn (array $entry): bool => $entry['recipe_id'] !== '')
            ->values();
    }

    private function servingMultiplier(Recipe $recipe, int $plannedServings): float
    {
        $recipeServings = max((int) $recipe->servings, 1);

        return max($plannedServings, 1) / $recipeServings;
    }

    /**
     * @return array{key: string, name: string, quantity: float|null, unit: string|null, recipe_title: string}|null
     */
    private function parseIngredientLine(mixed $ingredient, float $multiplier, string $recipeTitle): ?array
    {
        $line = trim((string) $ingredient);

        if ($line === '') {
            return null;
        }

        $normalizedLine = (string) Str::of($line)
            ->replaceMatches('/\([^)]*\)/', '')
            ->replace(',', ' ')
            ->replaceMatches('/\s+/', ' ')
            ->trim();

        if ($normalizedLine === '') {
            return null;
        }

        $tokens = preg_split('/\s+/', Str::lower($normalizedLine)) ?: [];
        $quantity = $this->parseLeadingQuantity($tokens);
        $unit = $this->parseLeadingUnit($tokens);
        $name = $this->normalizeIngredientName($tokens, $normalizedLine);

        return [
            'key' => $name,
            'name' => $name,
            'quantity' => $quantity === null ? null : $quantity * $multiplier,
            'unit' => $unit,
            'recipe_title' => $recipeTitle,
        ];
    }

    /**
     * @param  list<string>  $tokens
     */
    private function normalizeIngredientName(array $tokens, string $fallback): string
    {
        $name = trim(implode(' ', $tokens));
        $name = preg_replace('/^of\s+/i', '', $name) ?? $name;
        $name = $name !== '' ? $name : Str::lower($fallback);

        $parts = preg_split('/\s+/', $name) ?: [];

        if ($parts === []) {
            return Str::lower($fallback);
        }

        $lastPart = array_pop($parts);
        $lastPart = $lastPart === null ? '' : Str::singular($lastPart);
        $normalized = trim(implode(' ', [...$parts, $lastPart]));

        return $normalized !== '' ? $normalized : Str::lower($fallback);
    }

    /**
     * @param  list<string>  $tokens
     */
    private function parseLeadingQuantity(array &$tokens): ?float
    {
        if ($tokens === []) {
            return null;
        }

        $firstToken = rtrim($tokens[0], '.,');

        if (preg_match('/^\d+(?:\.\d+)?$/', $firstToken) === 1) {
            $quantity = (float) $firstToken;
            array_shift($tokens);

            if ($tokens !== [] && preg_match('/^\d+\/\d+$/', $tokens[0]) === 1) {
                $quantity += $this->fractionToFloat(array_shift($tokens));
            }

            return $quantity;
        }

        if (preg_match('/^\d+\/\d+$/', $firstToken) === 1) {
            array_shift($tokens);

            return $this->fractionToFloat($firstToken);
        }

        return null;
    }

    /**
     * @param  list<string>  $tokens
     */
    private function parseLeadingUnit(array &$tokens): ?string
    {
        if ($tokens === []) {
            return null;
        }

        $units = [
            'tbsp' => 'tbsp',
            'tablespoon' => 'tbsp',
            'tablespoons' => 'tbsp',
            'tsp' => 'tsp',
            'teaspoon' => 'tsp',
            'teaspoons' => 'tsp',
            'cup' => 'cup',
            'cups' => 'cup',
            'clove' => 'clove',
            'cloves' => 'clove',
            'slice' => 'slice',
            'slices' => 'slice',
            'can' => 'can',
            'cans' => 'can',
            'oz' => 'oz',
            'ounce' => 'oz',
            'ounces' => 'oz',
            'g' => 'g',
            'gram' => 'g',
            'grams' => 'g',
            'gm' => 'g',
            'gms' => 'g',
            'kg' => 'kg',
            'lb' => 'lb',
            'lbs' => 'lb',
            'pound' => 'lb',
            'pounds' => 'lb',
            'ml' => 'ml',
            'l' => 'l',
        ];

        $token = rtrim($tokens[0], '.,');

        if (! array_key_exists($token, $units)) {
            return null;
        }

        array_shift($tokens);

        return $units[$token];
    }

    private function fractionToFloat(string $fraction): float
    {
        [$numerator, $denominator] = array_pad(explode('/', $fraction, 2), 2, '1');

        if ((float) $denominator === 0.0) {
            return 0.0;
        }

        return (float) $numerator / (float) $denominator;
    }

    private function formatQuantity(float $quantity): string
    {
        $rounded = round($quantity, 2);

        if (fmod($rounded, 1.0) === 0.0) {
            return (string) (int) $rounded;
        }

        return rtrim(rtrim(number_format($rounded, 2, '.', ''), '0'), '.');
    }
}
