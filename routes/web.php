<?php

use App\Http\Controllers\Admin\BrowseRecipeController;
use App\Http\Controllers\Admin\MealPlannerController;
use App\Http\Controllers\Admin\SavedRecipeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\MealPlan;
use App\Models\Recipe;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
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
    })->name('dashboard');

    // Route::get('/browse-recipes', function () {
    //     return view('app.placeholder', [
    //         'title' => 'FoodFork - Browse Recipes',
    //         'active' => 'browse',
    //         'topbarTitle' => 'Browse Recipes',
    //     ]);
    // })->name('browse-recipes');

    Route::get('/browse-recipes', [BrowseRecipeController::class, 'index'])->name('browse-recipes');
    Route::get('/api/browse-recipes/tags', [BrowseRecipeController::class, 'tags'])->name('browse-recipes.tags');
    Route::get('/api/browse-recipes', [BrowseRecipeController::class, 'recipes'])->name('browse-recipes.api');
    Route::get('/api/saved-recipes', [SavedRecipeController::class, 'index'])->name('saved-recipes.index');
    Route::post('/api/saved-recipes/{spoonacularId}', [SavedRecipeController::class, 'store'])->name('saved-recipes.store');
    Route::delete('/api/saved-recipes/{spoonacularId}', [SavedRecipeController::class, 'destroy'])->name('saved-recipes.destroy');

    Route::get('/meal-planner', [MealPlannerController::class, 'index'])->name('meal-planner');
    Route::get('/api/meal-planner', [MealPlannerController::class, 'planner'])->name('meal-planner.api');
    Route::put('/api/meal-planner', [MealPlannerController::class, 'savePlanner'])->name('meal-planner.save');

    // Route::get('/meal-planner', function () {
    //     return view('app.placeholder', [
    //         'title' => 'FoodFork - Meal Planner',
    //         'active' => 'planner',
    //         'topbarTitle' => 'Meal Planner',
    //     ]);
    // })->name('meal-planner');

    Route::get('/grocery-list', function () {
        return view('app.placeholder', [
            'title' => 'FoodFork - Grocery List',
            'active' => 'grocery',
            'topbarTitle' => 'Grocery List',
        ]);
    })->name('grocery-list');

    Route::get('/add-recipe', function () {
        return view('app.placeholder', [
            'title' => 'FoodFork - Add Recipe',
            'active' => 'add-recipe',
            'topbarTitle' => 'Add Recipe',
        ]);
    })->name('add-recipe');

    Route::get('/business', function () {
        return view('app.placeholder', [
            'title' => 'FoodFork - Local Businesses',
            'active' => 'business',
            'topbarTitle' => 'Local Businesses',
        ]);
    })->name('business');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
