<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MealPlannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.dashboard.mealPlanner', [
            'title' => 'FoodFork - Meal Planner',
            'active' => 'planner',
            'topbarTitle' => 'Meal Planner',
        ]);
    }

    public function planner(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'week_start' => ['required', 'date_format:Y-m-d'],
        ]);

        $mealPlan = MealPlan::query()
            ->where('user_id', (int) $request->user()->id)
            ->whereDate('week_start', $validated['week_start'])
            ->first();

        return response()->json([
            'data' => [
                'week_start' => $validated['week_start'],
                'planner_data' => is_array($mealPlan?->planner_data) ? $mealPlan->planner_data : null,
            ],
        ]);
    }

    public function savePlanner(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'week_start' => ['required', 'date_format:Y-m-d'],
            'planner_data' => ['required', 'array'],
        ]);

        $mealPlan = MealPlan::query()->updateOrCreate(
            [
                'user_id' => (int) $request->user()->id,
                'week_start' => $validated['week_start'],
            ],
            [
                'planner_data' => $validated['planner_data'],
            ],
        );

        return response()->json([
            'message' => 'Meal plan saved successfully.',
            'data' => [
                'id' => $mealPlan->id,
                'week_start' => $validated['week_start'],
            ],
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
