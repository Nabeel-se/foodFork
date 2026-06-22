<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\EmbeddingProvider;
use App\Models\Recipe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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

    public function addRecipePost(Request $request)
    {
        // Validate and process the form data here
        // You can use $request->input('field_name') to get the form data

        // For example, to get the title:
        $title = $request->input('title');
        $embedding = null;

        if ($request->file('thumbnail')) {
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate that it's an image and limit size
            ]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'instructions' => 'nullable|array',
            'minutes' => 'nullable|integer',
            'calories' => 'nullable|integer',
            'dish_types' => 'nullable|array',
            'diets' => 'nullable|array',
            'ingredients' => 'nullable|array',
            'value' => 'nullable|array',
            'unit' => 'nullable|array',
            'ingredients.*' => 'nullable|string',
            'value.*' => 'required_with:ingredients.*',
            'unit.*' => 'required_with:ingredients.*',
            'protein' => 'nullable|numeric',
            'fats' => 'nullable|numeric',
        ]);

        $filename = null;
        if ($request->hasFile('thumbnail')) {

            $file = $request->file('thumbnail');

            $filename = time().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);
        }

        $instruction1 = null;
        $li = '';
        if (count($request->input('instructions', [])) > 0) {
            foreach ($request->input('instructions', []) as $instruction) {
                $li .= '<li>'.e($instruction).'</li>';
            }

            $instruction1 = '<ol>'.$li.'</ol>';
        }

        $embeddingsEnabled = (bool) config('services.embeddings.enabled', true);
        $embeddingProvider = $embeddingsEnabled ? app(EmbeddingProvider::class) : null;

        if ($embeddingProvider instanceof EmbeddingProvider) {
            try {
                $embeddingVector = $embeddingProvider->embed($this->buildEmbeddingText(
                    title: (string) $request->input('title'),
                    summary: $request->input('summary', ''),
                    instructions: $instruction1,
                    dishTypes: $request->input('dish_types', []),
                    diets: $request->input('diets', []),
                    ingredients: $request->input('ingredients', []),
                    calories: $request->input('calories', null),
                    proteinAmount: $request->input('protein_amount', null),
                    proteinUnit: $request->input('protein_unit', null),
                    fatAmount: $request->input('fat_amount', null),
                    fatUnit: $request->input('fat_unit', null),
                    readyInMinutes: (int) ($request->input('ready_in_minutes', 0)),
                    servings: (int) ($request->input('servings', 0)),
                ));

                if ($embeddingVector !== []) {
                    $embedding = json_encode($embeddingVector, JSON_THROW_ON_ERROR);
                }
            } catch (Throwable $exception) {
                Log::warning('Recipe embedding generation failed during Spoonacular sync.', [
                    'recipe_id' => (string) $this->generateRandomId(),
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        $ingredients = [];
        foreach ($request->ingredients as $index => $ingredient) {
            $ingredients[] = trim(
                ($request->value[$index] ?? '') . ' ' .
                ($request->unit[$index] ?? ''). ' ' .
                $ingredient
            );
        }

        Recipe::create([
            'spoonacular_id' => $this->generateRandomId(), // create unique ID or leave null if not needed
            'title' => $title, // You can generate or assign a unique ID as needed
            'image' => 'uploads/'.$filename,
            'summary' => $request->input('summary'), // You can generate or assign a unique ID as needed
            'instructions' => $instruction1, // You can generate or assign a unique ID as needed
            'ready_in_minutes' => $request->input('minutes'), // You can generate or assign a unique ID as needed
            'servings' => 1, // You can generate or assign a unique ID as needed
            'calories' => $request->input('calories'), // You can generate or assign a unique ID as needed
            'dish_types' => $request->input('dish_types'), // You can generate or assign a unique ID as needed
            'diets' => $request->input('diets'), // You can generate or assign a unique ID as needed
            'ingredients' => $ingredients, // You can generate or assign a unique ID as needed
            'protein' => $request->input('protein'), // You can generate or assign a unique ID as needed
            'protein_unit' => 'g', // You can generate or assign a unique ID as needed
            'fat' => $request->input('fats'), // You can generate or assign a unique ID as needed
            'fat_unit' => 'g', // You can generate or assign a unique ID as needed
            'embedding' => $embedding,  // It is a json array of floats, for searching
        ]);

        // After processing, you can redirect back or to another page
        return redirect()->route('add-recipe')->with('success', 'Recipe added successfully!');
    }

    private function normalizeList(array $items): string
    {
        $normalized = array_map(static fn (mixed $item): string => is_string($item) ? trim($item) : '', $items);

        return implode(', ', array_filter($normalized, static fn (string $item): bool => $item !== ''));
    }

    private function nullableScalar($value): string
    {
        if (is_null($value)) {
            return 'null';
        }

        if (is_scalar($value)) {
            return (string) $value;
        }

        return 'invalid';
    }

    private function generateRandomId($length = 6)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $id;
    }

    private function buildEmbeddingText(
        string $title,
        string $summary,
        ?string $instructions,
        array $dishTypes,
        array $diets,
        array $ingredients,
        ?int $calories,
        ?float $proteinAmount,
        ?string $proteinUnit,
        ?float $fatAmount,
        ?string $fatUnit,
        int $readyInMinutes,
        int $servings,
    ): string {
        $parts = [
            'title: '.trim($title),
            'summary: '.trim(strip_tags($summary)),
            'instructions: '.trim(strip_tags((string) $instructions)),
            'dish_types: '.$this->normalizeList($dishTypes),
            'diets: '.$this->normalizeList($diets),
            'ingredients: '.$this->normalizeList($ingredients),
            'nutrition: calories='.$this->nullableScalar($calories).', protein='.$this->nullableScalar($proteinAmount).' '.trim((string) $proteinUnit).', fat='.$this->nullableScalar($fatAmount).' '.trim((string) $fatUnit),
            'meal: ready_in_minutes='.$this->nullableScalar($readyInMinutes).', servings='.$this->nullableScalar($servings),
        ];

        return implode("\n", $parts);
    }
}
