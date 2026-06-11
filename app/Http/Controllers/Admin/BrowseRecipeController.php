<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmbeddingProvider;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Throwable;

class BrowseRecipeController extends Controller
{
    public function __construct(private readonly EmbeddingProvider $embeddingProvider) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.dashboard.browseRecipe', [
            'title' => 'FoodFork - Browse Recipes',
            'active' => 'browse',
            'topbarTitle' => 'Browse Recipes',
        ]);
    }

    /**
     * Return available dish type and diet tags with counts.
     */
    public function tags(): JsonResponse
    {
        $recipes = Recipe::query()->select(['dish_types', 'diets'])->get();

        /** @var array<string, int> $dishTypeCounts */
        $dishTypeCounts = [];

        /** @var array<string, int> $dietCounts */
        $dietCounts = [];

        foreach ($recipes as $recipe) {
            foreach ((array) $recipe->dish_types as $dishType) {
                if (! is_string($dishType) || trim($dishType) === '') {
                    continue;
                }

                $normalized = Str::of($dishType)->lower()->trim()->toString();
                $dishTypeCounts[$normalized] = ($dishTypeCounts[$normalized] ?? 0) + 1;
            }

            foreach ((array) $recipe->diets as $diet) {
                if (! is_string($diet) || trim($diet) === '') {
                    continue;
                }

                $normalized = Str::of($diet)->lower()->trim()->toString();
                $dietCounts[$normalized] = ($dietCounts[$normalized] ?? 0) + 1;
            }
        }

        arsort($dishTypeCounts);
        arsort($dietCounts);

        $dishTypes = collect($dishTypeCounts)->map(fn (int $count, string $value): array => [
            'value' => $value,
            'label' => Str::of($value)->headline()->toString(),
            'count' => $count,
            'type' => 'dish_type',
        ])->values();

        $diets = collect($dietCounts)->map(fn (int $count, string $value): array => [
            'value' => $value,
            'label' => Str::of($value)->headline()->toString(),
            'count' => $count,
            'type' => 'diet',
        ])->values();

        return response()->json([
            'dish_types' => $dishTypes,
            'diets' => $diets,
        ]);
    }

    /**
     * Return paginated recipes from database with optional tag filters.
     */
    public function recipes(Request $request): JsonResponse
    {
        $dishTypes = array_values(array_filter((array) $request->query('dish_types', []), fn (mixed $value): bool => is_string($value) && trim($value) !== ''));
        $diets = array_values(array_filter((array) $request->query('diets', []), fn (mixed $value): bool => is_string($value) && trim($value) !== ''));
        $search = trim((string) $request->query('search', ''));
        $perPage = min(max((int) $request->query('per_page', 24), 1), 50);
        $semanticEnabled = $this->canUseSemanticSearch();

        $query = Recipe::query()->latest('updated_at');

        foreach ($dishTypes as $dishType) {
            $query->whereJsonContains('dish_types', Str::of($dishType)->lower()->trim()->toString());
        }

        foreach ($diets as $diet) {
            $query->whereJsonContains('diets', Str::of($diet)->lower()->trim()->toString());
        }

        if ($search !== '') {
            $hybridPaginator = null;

            if ($semanticEnabled) {
                $hybridPaginator = $this->hybridPaginate($query, $search, $perPage, (int) $request->query('page', 1));
            }

            if ($hybridPaginator !== null) {
                $recipes = $hybridPaginator->getCollection()->map(function (Recipe $recipe): array {
                    $dishTypes = is_array($recipe->dish_types) ? $recipe->dish_types : [];
                    $diets = is_array($recipe->diets) ? $recipe->diets : [];
                    $ingredients = is_array($recipe->ingredients) ? $recipe->ingredients : [];

                    return [
                        'id' => (string) $recipe->spoonacular_id,
                        'title' => $recipe->title,
                        'image' => $recipe->image,
                        'summary' => trim(strip_tags((string) $recipe->summary)),
                        'instructions' => $this->splitInstructions((string) $recipe->instructions),
                        'ready_in_minutes' => $recipe->ready_in_minutes,
                        'servings' => $recipe->servings,
                        'calories' => $recipe->calories,
                        'protein' => $recipe->protein,
                        'protein_unit' => $recipe->protein_unit,
                        'fat' => $recipe->fat,
                        'fat_unit' => $recipe->fat_unit,
                        'dish_types' => $dishTypes,
                        'diets' => $diets,
                        'ingredients' => $ingredients,
                        'category' => $this->buildCategory($dishTypes, $diets),
                    ];
                })->values();

                return response()->json([
                    'data' => $recipes,
                    'meta' => [
                        'current_page' => $hybridPaginator->currentPage(),
                        'last_page' => $hybridPaginator->lastPage(),
                        'per_page' => $hybridPaginator->perPage(),
                        'total' => $hybridPaginator->total(),
                        'has_more' => $hybridPaginator->hasMorePages(),
                        'semantic_enabled' => $semanticEnabled,
                        'semantic_used' => true,
                    ],
                ]);
            }

            $query->where(function ($innerQuery) use ($search): void {
                $innerQuery
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('instructions', 'like', "%{$search}%");
            });
        }

        $paginator = $query->paginate($perPage);

        $recipes = $paginator->getCollection()->map(function (Recipe $recipe): array {
            $dishTypes = is_array($recipe->dish_types) ? $recipe->dish_types : [];
            $ingredients = is_array($recipe->ingredients) ? $recipe->ingredients : [];
            $diets = is_array($recipe->diets) ? $recipe->diets : [];

            return [
                'id' => (string) $recipe->spoonacular_id,
                'title' => $recipe->title,
                'image' => $recipe->image,
                'summary' => trim(strip_tags((string) $recipe->summary)),
                'instructions' => $this->splitInstructions((string) $recipe->instructions),
                'ready_in_minutes' => $recipe->ready_in_minutes,
                'servings' => $recipe->servings,
                'calories' => $recipe->calories,
                'protein' => $recipe->protein,
                'protein_unit' => $recipe->protein_unit,
                'fat' => $recipe->fat,
                'fat_unit' => $recipe->fat_unit,
                'dish_types' => $dishTypes,
                'ingredients' => $ingredients,
                'diets' => $diets,
                'category' => $this->buildCategory($dishTypes, $diets),
            ];
        })->values();

        return response()->json([
            'data' => $recipes,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'has_more' => $paginator->hasMorePages(),
                'semantic_enabled' => $semanticEnabled,
                'semantic_used' => false,
            ],
        ]);
    }

    private function canUseSemanticSearch(): bool
    {
        $enabled = (bool) config('services.embeddings.enabled', true);
        $driver = (string) config('services.embeddings.driver', 'local');

        if (! $enabled) {
            return false;
        }

        if ($driver === 'openai') {
            return trim((string) config('services.openai.key', '')) !== '';
        }

        return true;
    }

    private function hybridPaginate($baseQuery, string $search, int $perPage, int $page): ?LengthAwarePaginator
    {
        try {
            $queryEmbedding = $this->embeddingProvider->embed($this->buildEmbeddingQueryText($search));
        } catch (Throwable) {
            return null;
        }

        if ($queryEmbedding === []) {
            return null;
        }

        $candidates = (clone $baseQuery)
            ->select([
                'id',
                'spoonacular_id',
                'title',
                'image',
                'summary',
                'instructions',
                'ready_in_minutes',
                'servings',
                'calories',
                'protein',
                'protein_unit',
                'fat',
                'fat_unit',
                'dish_types',
                'diets',
                'ingredients',
                'embedding',
                'updated_at',
            ])
            ->limit(300)
            ->get();

        $scoredRecipes = $candidates
            ->map(function (Recipe $recipe) use ($search, $queryEmbedding): array {
                $vectorScore = $this->cosineSimilarity($queryEmbedding, is_array($recipe->embedding) ? $recipe->embedding : []);
                $keywordScore = $this->keywordScore($search, $recipe);
                $hybridScore = (0.7 * $vectorScore) + (0.3 * $keywordScore);

                return [
                    'recipe' => $recipe,
                    'score' => $hybridScore,
                    'keyword' => $keywordScore,
                    'vector' => $vectorScore,
                ];
            })
            ->filter(static fn (array $item): bool => $item['keyword'] > 0.0 || $item['vector'] >= 0.2)
            ->sortByDesc('score')
            ->values();

        $total = $scoredRecipes->count();

        if ($total === 0) {
            return new LengthAwarePaginator(collect(), 0, $perPage, $page);
        }

        $offset = max(($page - 1) * $perPage, 0);
        $items = $scoredRecipes
            ->slice($offset, $perPage)
            ->map(static fn (array $item): Recipe => $item['recipe'])
            ->values();

        return new LengthAwarePaginator($items, $total, $perPage, $page);
    }

    private function buildEmbeddingQueryText(string $search): string
    {
        return 'recipe search: '.trim($search);
    }

    private function keywordScore(string $search, Recipe $recipe): float
    {
        $term = Str::lower(trim($search));

        if ($term === '') {
            return 0.0;
        }

        $title = Str::lower((string) $recipe->title);
        $summary = Str::lower(strip_tags((string) $recipe->summary));
        $instructions = Str::lower(strip_tags((string) $recipe->instructions));
        $dishTypes = Str::lower(implode(' ', is_array($recipe->dish_types) ? $recipe->dish_types : []));
        $diets = Str::lower(implode(' ', is_array($recipe->diets) ? $recipe->diets : []));
        $ingredients = Str::lower(implode(' ', is_array($recipe->ingredients) ? $recipe->ingredients : []));

        $score = 0.0;

        if (Str::contains($title, $term)) {
            $score += 1.0;
        }

        if (Str::contains($summary, $term)) {
            $score += 0.6;
        }

        if (Str::contains($instructions, $term)) {
            $score += 0.4;
        }

        if (Str::contains($dishTypes, $term)) {
            $score += 0.4;
        }

        if (Str::contains($diets, $term)) {
            $score += 0.4;
        }

        if (Str::contains($ingredients, $term)) {
            $score += 0.4;
        }

        return min($score / 3.2, 1.0);
    }

    /**
     * @param  list<float|int>  $a
     * @param  list<float|int>  $b
     */
    private function cosineSimilarity(array $a, array $b): float
    {
        if ($a === [] || $b === []) {
            return 0.0;
        }

        $length = min(count($a), count($b));

        if ($length === 0) {
            return 0.0;
        }

        $dot = 0.0;
        $aNorm = 0.0;
        $bNorm = 0.0;

        for ($index = 0; $index < $length; $index++) {
            $left = (float) $a[$index];
            $right = (float) $b[$index];
            $dot += $left * $right;
            $aNorm += $left * $left;
            $bNorm += $right * $right;
        }

        if ($aNorm <= 0.0 || $bNorm <= 0.0) {
            return 0.0;
        }

        return $dot / (sqrt($aNorm) * sqrt($bNorm));
    }

    /**
     * Normalize instruction text into step strings.
     *
     * @return list<string>
     */
    private function splitInstructions(string $instructions): array
    {
        $instructions = trim(strip_tags($instructions));

        if ($instructions === '') {
            return [];
        }

        $steps = preg_split('/\r\n|\r|\n|(?<=\.)\s+/', $instructions) ?: [];

        return array_values(array_filter(array_map(static fn (string $step): string => trim($step), $steps), static fn (string $step): bool => $step !== ''));
    }

    /**
     * Pick a single category label for card visualization.
     */
    private function buildCategory(array $dishTypes, array $diets): string
    {
        foreach ($dishTypes as $dishType) {
            if (is_string($dishType) && trim($dishType) !== '') {
                return Str::of($dishType)->lower()->trim()->toString();
            }
        }

        foreach ($diets as $diet) {
            if (is_string($diet) && trim($diet) !== '') {
                return Str::of($diet)->lower()->trim()->toString();
            }
        }

        return 'all';
    }
}
