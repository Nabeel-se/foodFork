<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\MealPlan;
use Carbon\Carbon;

class HomeController extends Controller
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

        $now = Carbon::now();
        $monday = $now->copy()->startOfWeek(Carbon::MONDAY);
        $dayLabel = $now->format('D');

        $mealPlan = MealPlan::query()
            ->where('user_id', (int) $user->id)
            ->whereDate('week_start', $monday->toDateString())
            ->first();

        $plannerData = is_array($mealPlan?->planner_data) ? $mealPlan->planner_data : [];
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $slots = ['breakfast', 'lunch', 'dinner'];

        $weeklyEntries = collect($days)
            ->flatMap(function (string $day) use ($plannerData, $slots) {
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

        $plannedRecipeIds = $weeklyEntries
            ->pluck('recipe_id')
            ->filter(static fn (string $recipeId): bool => $recipeId !== '')
            ->unique()
            ->values();

        $recipeIds = collect($slots)
            ->map(static fn (string $slot): string => (string) data_get($plannerData, $dayLabel.'-'.$slot.'.recipeId', ''))
            ->filter(static fn (string $recipeId): bool => $recipeId !== '')
            ->values();

        $recipesBySpoonacularId = Recipe::query()
            ->whereIn('spoonacular_id', $recipeIds, 'and', false)
            ->get()
            ->keyBy('spoonacular_id');

        $weeklyRecipesBySpoonacularId = Recipe::query()
            ->whereIn('spoonacular_id', $plannedRecipeIds, 'and', false)
            ->get()
            ->keyBy('spoonacular_id');

        $todayMeals = collect($slots)->map(function (string $slot) use ($plannerData, $dayLabel, $recipesBySpoonacularId): array {
            $entry = data_get($plannerData, $dayLabel.'-'.$slot, []);
            $recipeId = (string) data_get($entry, 'recipeId', '');
            $servings = max((int) data_get($entry, 'servings', 1), 1);
            $recipe = $recipeId !== '' ? $recipesBySpoonacularId->get($recipeId) : null;

            return [
                'slot' => $slot,
                'recipe' => $recipe,
                'servings' => $servings,
            ];
        })->all();

        $dailyCalories = collect($todayMeals)->sum(function (array $meal): int {
            $calories = is_numeric(data_get($meal, 'recipe.calories')) ? (int) data_get($meal, 'recipe.calories') : 0;

            return $calories * (int) $meal['servings'];
        });

        $weeklyPlanDays = collect($days)->map(function (string $day) use ($plannerData, $weeklyRecipesBySpoonacularId, $slots): array {
            $meals = collect($slots)->map(function (string $slot) use ($plannerData, $day, $weeklyRecipesBySpoonacularId): array {
                $entry = data_get($plannerData, $day.'-'.$slot, []);
                $recipeId = (string) data_get($entry, 'recipeId', '');
                $servings = max((int) data_get($entry, 'servings', 1), 1);
                $recipe = $recipeId !== '' ? $weeklyRecipesBySpoonacularId->get($recipeId) : null;

                return [
                    'slot' => $slot,
                    'recipe' => $recipe,
                    'servings' => $servings,
                ];
            })->all();

            return [
                'day' => $day,
                'meals' => $meals,
            ];
        })->all();

        $savedRecipesCount = $user->savedRecipes()->count();
        $weeklyMealsPlannedCount = $weeklyEntries->count();
        $todayMealsPlannedCount = collect($todayMeals)->filter(static fn (array $meal): bool => data_get($meal, 'recipe') instanceof Recipe)->count();
        $weeklyCalories = $weeklyEntries->sum(function (array $entry) use ($weeklyRecipesBySpoonacularId): int {
            $recipe = $weeklyRecipesBySpoonacularId->get($entry['recipe_id']);
            $calories = $recipe instanceof Recipe && is_numeric($recipe->calories) ? (int) $recipe->calories : 0;

            return $calories * $entry['servings'];
        });

        $weeklyFilledDayCount = collect($days)
            ->filter(function (string $day) use ($plannerData, $slots): bool {
                foreach ($slots as $slot) {
                    if (trim((string) data_get($plannerData, $day.'-'.$slot.'.recipeId', '')) !== '') {
                        return true;
                    }
                }

                return false;
            })
            ->count();

        // Calculate total ingredient items for weekly planned meals.
        // Note: This counts item lines, not quantities by servings, and item count as 1.
        // For example, "2 cloves garlic" and "1 clove garlic" are both counted as one item line each.
        // Future enhancement: parse quantities and aggregate by ingredient name for true grocery list math.
        $weeklyIngredientItemsCount = $weeklyEntries->sum(function (array $entry) use ($weeklyRecipesBySpoonacularId): int {
            $recipe = $weeklyRecipesBySpoonacularId->get($entry['recipe_id']);

            if (! $recipe instanceof Recipe) {
                return 0;
            }

            return collect(is_array($recipe->ingredients) ? $recipe->ingredients : [])
                ->map(static fn (mixed $ingredient): string => trim((string) $ingredient))
                ->filter(static fn (string $ingredient): bool => $ingredient !== '')
                ->count();
        });

        $groceryIngredients = $weeklyRecipesBySpoonacularId
            ->flatMap(static fn (Recipe $recipe): array => is_array($recipe->ingredients) ? $recipe->ingredients : [])
            ->map(static fn (mixed $ingredient): string => trim((string) $ingredient))
            ->filter(static fn (string $ingredient): bool => $ingredient !== '')
            ->countBy()
            ->sortDesc()
            ->map(static fn (int $count, string $ingredient): array => [
                'name' => $ingredient,
                'count' => $count,
            ])
            ->values()
            ->take(12);

        $uniqueIngredientsCount = $weeklyRecipesBySpoonacularId
            ->flatMap(static fn (Recipe $recipe): array => is_array($recipe->ingredients) ? $recipe->ingredients : [])
            ->map(static fn (mixed $ingredient): string => trim((string) $ingredient))
            ->filter(static fn (string $ingredient): bool => $ingredient !== '')
            ->unique()
            ->count();

        $mealCompletionPercent = min((int) round(($weeklyMealsPlannedCount / 21) * 100), 100);
        $groceryReadyPercent = $mealCompletionPercent;
        $avgDailyCalories = (int) round($weeklyCalories / 7);
        $calorieGoal = 2000;
        $calorieGoalPercent = min((int) round(($avgDailyCalories / $calorieGoal) * 100), 100);

        $trendingRecipes = Recipe::query()
            ->select(['spoonacular_id', 'title', 'image', 'ready_in_minutes', 'servings', 'calories', 'dish_types'])
            ->latest('updated_at')
            ->limit(4)
            ->get();

        return view('app.dashboard', [
            'todayMeals' => $todayMeals,
            'dailyCalories' => $dailyCalories,
            'savedRecipesCount' => $savedRecipesCount,
            'todayMealsPlannedCount' => $todayMealsPlannedCount,
            'weeklyMealsPlannedCount' => $weeklyMealsPlannedCount,
            'weeklyPlanDays' => $weeklyPlanDays,
            'weeklyFilledDayCount' => $weeklyFilledDayCount,
            'weeklyIngredientItemsCount' => $weeklyIngredientItemsCount,
            'groceryIngredients' => $groceryIngredients,
            'uniqueIngredientsCount' => $uniqueIngredientsCount,
            'weeklyCalories' => $weeklyCalories,
            'avgDailyCalories' => $avgDailyCalories,
            'calorieGoal' => $calorieGoal,
            'mealCompletionPercent' => $mealCompletionPercent,
            'groceryReadyPercent' => $groceryReadyPercent,
            'calorieGoalPercent' => $calorieGoalPercent,
            'trendingRecipes' => $trendingRecipes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
