<?php

use App\Http\Controllers\Admin\BrowseRecipeController;
use App\Http\Controllers\Admin\MealPlannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('app.dashboard');
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
