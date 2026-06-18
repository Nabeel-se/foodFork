<?php

use App\Http\Controllers\Admin\BrowseRecipeController;
use App\Http\Controllers\Admin\MealPlannerController;
use App\Http\Controllers\Admin\SavedRecipeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/features', [App\Http\Controllers\HomeController::class, 'features'])->name('features');
Route::get('/recipes', [App\Http\Controllers\HomeController::class, 'recipes'])->name('recipes');
Route::get('/planner', [App\Http\Controllers\HomeController::class, 'planner'])->name('planner');
Route::get('/reviews', [App\Http\Controllers\HomeController::class, 'reviews'])->name('reviews');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/why-food4fork', [App\Http\Controllers\HomeController::class, 'whyFood4Fork'])->name('why-food4fork');
Route::get('/partner-with-us', [App\Http\Controllers\HomeController::class, 'partners'])->name('partner-with-us');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faqs'])->name('faq');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blogs'])->name('blog');
Route::get('/account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/feedback', [App\Http\Controllers\HomeController::class, 'feedback'])->name('feedback');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');

    Route::get('/browse-recipes', [BrowseRecipeController::class, 'index'])->name('browse-recipes');
    Route::get('/api/browse-recipes/tags', [BrowseRecipeController::class, 'tags'])->name('browse-recipes.tags');
    Route::get('/api/browse-recipes', [BrowseRecipeController::class, 'recipes'])->name('browse-recipes.api');
    Route::get('/api/saved-recipes', [SavedRecipeController::class, 'index'])->name('saved-recipes.index');
    Route::post('/api/saved-recipes/{spoonacularId}', [SavedRecipeController::class, 'store'])->name('saved-recipes.store');
    Route::delete('/api/saved-recipes/{spoonacularId}', [SavedRecipeController::class, 'destroy'])->name('saved-recipes.destroy');

    Route::get('/meal-planner', [MealPlannerController::class, 'index'])->name('meal-planner');
    Route::get('/api/meal-planner', [MealPlannerController::class, 'planner'])->name('meal-planner.api');
    Route::put('/api/meal-planner', [MealPlannerController::class, 'savePlanner'])->name('meal-planner.save');

    Route::get('/grocery-list', [App\Http\Controllers\Admin\GroceryController::class, 'index'])->name('grocery-list');
    Route::get('/add-recipe', [App\Http\Controllers\Admin\SavedRecipeController::class, 'addRecipe'])->name('add-recipe');

    Route::get('/business', function () {
        return view('app.placeholder', [
            'title' => 'FoodFork - Local Businesses',
            'active' => 'business',
            'topbarTitle' => 'Local Businesses',
        ]);
    })->name('business');

    // profile routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
