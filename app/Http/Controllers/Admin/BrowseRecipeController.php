<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrowseRecipeController extends Controller
{
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

        $query = Recipe::query()->latest('updated_at');

        foreach ($dishTypes as $dishType) {
            $query->whereJsonContains('dish_types', Str::of($dishType)->lower()->trim()->toString());
        }

        foreach ($diets as $diet) {
            $query->whereJsonContains('diets', Str::of($diet)->lower()->trim()->toString());
        }

        if ($search !== '') {
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
            ],
        ]);
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
