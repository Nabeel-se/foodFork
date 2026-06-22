<?php

namespace Tests\Feature;

use App\Models\MealPlan;
use App\Models\Recipe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroceryListTest extends TestCase
{
    use RefreshDatabase;

    public function test_grocery_list_groups_similar_ingredients_for_current_week(): void
    {
        Carbon::setTestNow('2026-06-17 10:00:00');

        /** @var User $user */
        $user = User::factory()->create();

        Recipe::query()->create([
            'spoonacular_id' => 'recipe-1',
            'title' => 'Veggie Omelette',
            'servings' => 1,
            'ingredients' => ['1 onion', '1 tbsp olive oil'],
        ]);

        Recipe::query()->create([
            'spoonacular_id' => 'recipe-2',
            'title' => 'Garlic Pasta',
            'servings' => 1,
            'ingredients' => ['2 onions', '2 tbsp olive oil', '3 cloves garlic'],
        ]);

        MealPlan::query()->create([
            'user_id' => $user->id,
            'week_start' => Carbon::now()->startOfWeek(Carbon::MONDAY)->toDateString(),
            'planner_data' => [
                'Mon-breakfast' => ['recipeId' => 'recipe-1', 'servings' => 1],
                'Tue-dinner' => ['recipeId' => 'recipe-2', 'servings' => 1],
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/grocery-list');

        $response
            ->assertOk()
            ->assertViewHas('groceryItems', function ($items): bool {
                $items = collect($items);
                $onion = $items->firstWhere('name', 'onion');
                $oliveOil = $items->firstWhere('name', 'olive oil');
                $garlic = $items->firstWhere('name', 'garlic');

                return $onion !== null
                    && $onion['total'] === '3'
                    && $onion['recipes'] === ['Garlic Pasta', 'Veggie Omelette']
                    && $oliveOil !== null
                    && $oliveOil['total'] === '3 tbsp'
                    && $garlic !== null
                    && $garlic['total'] === '3 clove';
            })
            ->assertSeeText('onion')
            ->assertSeeText('3 tbsp')
            ->assertSeeText('Garlic Pasta')
            ->assertSeeText('Veggie Omelette');

        Carbon::setTestNow();
    }
}
