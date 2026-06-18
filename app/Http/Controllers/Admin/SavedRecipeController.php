<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavedRecipeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user === null) {
            abort(403);
        }

        $savedIds = $user->savedRecipes()
            ->pluck('recipes.spoonacular_id')
            ->filter(static fn (mixed $recipeId): bool => is_string($recipeId) && trim($recipeId) !== '')
            ->values();

        return response()->json([
            'data' => [
                'recipe_ids' => $savedIds,
            ],
        ]);
    }

    public function store(Request $request, string $spoonacularId): JsonResponse
    {
        $user = $request->user();

        if ($user === null) {
            abort(403);
        }

        $recipe = Recipe::query()
            ->where('spoonacular_id', $spoonacularId)
            ->first();

        if (! $recipe instanceof Recipe) {
            return response()->json([
                'message' => 'Recipe not found.',
            ], 404);
        }

        $user->savedRecipes()->syncWithoutDetaching([$recipe->id]);

        return response()->json([
            'message' => 'Recipe saved successfully.',
            'data' => [
                'recipe_id' => $spoonacularId,
                'saved' => true,
            ],
        ]);
    }

    public function destroy(Request $request, string $spoonacularId): JsonResponse
    {
        $user = $request->user();

        if ($user === null) {
            abort(403);
        }

        $recipe = Recipe::query()
            ->where('spoonacular_id', $spoonacularId)
            ->first();

        if ($recipe instanceof Recipe) {
            $user->savedRecipes()->detach($recipe->id);
        }

        return response()->json([
            'message' => 'Recipe removed from saved list.',
            'data' => [
                'recipe_id' => $spoonacularId,
                'saved' => false,
            ],
        ]);
    }

    public function addRecipe()
    {
        $diets = DB::table('recipes')
            ->selectRaw('DISTINCT jsonb_array_elements_text(diets::jsonb) as diet')
            ->orderBy('diet')
            ->pluck('diet');

        $dish_types = DB::table('recipes')
            ->selectRaw('DISTINCT jsonb_array_elements_text(dish_types::jsonb) as dish_types')
            ->orderBy('dish_types')
            ->pluck('dish_types');

        return view('app.dashboard.add-recipe', [
            'title' => 'FoodFork - Add Recipe',
            'active' => 'add-recipe',
            'topbarTitle' => 'Add Recipe',
            'diets' => $diets,
            'dish_types' => $dish_types,
        ]);
    }
}
