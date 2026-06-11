<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
