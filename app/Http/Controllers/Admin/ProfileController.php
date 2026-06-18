<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function edit()
    {
        $diets = DB::table('recipes')
            ->selectRaw('DISTINCT jsonb_array_elements_text(diets::jsonb) as diet')
            ->orderBy('diet')
            ->pluck('diet');

        return view('app.profile.edit', [
            'title' => 'FoodFork - Profile',
            'active' => 'profile',
            'topbarTitle' => 'Profile',
            'diets' => $diets,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'diets' => ['nullable', 'array'],
            'diets.*' => ['string'],
        ]);

        Profile::updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'phone' => $request->input('phone'),
                'bio' => $request->input('bio'),
                'diets' => $request->input('diets'),
            ]
        );

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');

        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
