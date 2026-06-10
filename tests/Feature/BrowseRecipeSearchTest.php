<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseRecipeSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Ensure browse API search returns only matching recipes in keyword mode.
     */
    public function test_authenticated_user_can_search_recipes_via_browse_api(): void
    {
        config()->set('services.embeddings.enabled', false);

        $user = User::factory()->create();

        Recipe::query()->create([
            'spoonacular_id' => 'recipe-1001',
            'title' => 'Lemon Chicken Bowl',
            'summary' => 'A bright chicken dish with citrus.',
            'instructions' => 'Cook chicken and finish with lemon zest.',
            'dish_types' => ['main course'],
            'diets' => ['gluten free'],
            'ready_in_minutes' => 25,
            'servings' => 2,
        ]);

        Recipe::query()->create([
            'spoonacular_id' => 'recipe-1002',
            'title' => 'Mushroom Pasta',
            'summary' => 'Creamy mushrooms and herbs.',
            'instructions' => 'Boil pasta and toss with mushroom sauce.',
            'dish_types' => ['dinner'],
            'diets' => ['vegetarian'],
            'ready_in_minutes' => 30,
            'servings' => 3,
        ]);

        $response = $this
            ->actingAs($user)
            ->getJson(route('browse-recipes.api', ['search' => 'chicken']));

        $response
            ->assertOk()
            ->assertJsonPath('meta.semantic_enabled', false)
            ->assertJsonPath('meta.semantic_used', false)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.title', 'Lemon Chicken Bowl');
    }
}
