@extends('layouts.app', [
    'title' => 'FoodFork - Dashboard',
    'active' => 'dashboard',
    'showSearch' => true,
])

@section('content')
<div class="page-header">
    <h2>Good morning, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h2>
    <p>Here's what's happening with your meal plan today.</p>
</div>

<div class="grid-4 mb-6">
    <div class="stat-card">
        <div class="stat-icon green">🍽️</div>
        <div class="stat-info">
            <div class="value">{{ number_format((int) ($savedRecipesCount ?? 0)) }}</div>
            <div class="label">Saved Recipes</div>
            <div class="change">In your collection</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">📅</div>
        <div class="stat-info">
            <div class="value">{{ number_format((int) ($todayMealsPlannedCount ?? 0)) }}</div>
            <div class="label">Meals Planned Today</div>
            <div class="change up">of 3 slots</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">🛒</div>
        <div class="stat-info">
            <div class="value">{{ number_format((int) ($weeklyIngredientItemsCount ?? 0)) }}</div>
            <div class="label">Grocery Items</div>
            <div class="change">{{ number_format((int) ($uniqueIngredientsCount ?? 0)) }} unique this week</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow">🔥</div>
        <div class="stat-info">
            <div class="value">{{ number_format((int) ($weeklyFilledDayCount ?? 0)) }}</div>
            <div class="label">Active Days</div>
            <div class="change up">of 7 this week</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;" class="dash-cols">
    <div style="display:flex;flex-direction:column;gap:24px;">
        <div class="card">
            <div class="card-header">
                <h4>📅 Today's Meal Plan</h4>
                <a href="{{ route('meal-planner') }}" class="btn btn-outline btn-sm">View Full Planner →</a>
            </div>
            <div class="card-body">
                <div style="display:flex;flex-direction:column;gap:12px;">
                    @foreach (($todayMeals ?? []) as $meal)
                        @php
                            $slot = (string) ($meal['slot'] ?? '');
                            $recipe = $meal['recipe'] ?? null;
                            $servings = (int) ($meal['servings'] ?? 1);
                            $slotMeta = match ($slot) {
                                'breakfast' => ['icon' => '🌅', 'label' => 'Breakfast'],
                                'lunch' => ['icon' => '☀️', 'label' => 'Lunch'],
                                'dinner' => ['icon' => '🌙', 'label' => 'Dinner'],
                                default => ['icon' => '🍽️', 'label' => ucfirst($slot)],
                            };
                            $calories = $recipe && is_numeric($recipe->calories) ? ((int) $recipe->calories * $servings) : null;
                            $protein = $recipe && is_numeric($recipe->protein) ? ((float) $recipe->protein * $servings) : null;
                            $minutes = $recipe && is_numeric($recipe->ready_in_minutes) ? (int) $recipe->ready_in_minutes : null;
                        @endphp
                        <div class="today-meal">
                            <div class="meal-time">{{ $slotMeta['icon'] }} {{ $slotMeta['label'] }}</div>
                            <div class="meal-detail">
                                @if ($recipe)
                                    <div class="meal-name">{{ $recipe->title }}</div>
                                    <div class="meal-macros">
                                        <span class="badge badge-primary">{{ $calories ?? 'N/A' }} kcal</span>
                                        <span class="badge badge-secondary">{{ $protein !== null ? number_format($protein, 1) : 'N/A' }}{{ $recipe->protein_unit ? ' '.strtolower((string) $recipe->protein_unit) : ' g' }} protein</span>
                                        <span style="font-size:.78rem;color:var(--text-muted);">{{ $minutes ? $minutes.' min' : 'N/A' }} · {{ $servings }} serving{{ $servings > 1 ? 's' : '' }}</span>
                                    </div>
                                @else
                                    <div class="meal-name">No meal planned yet</div>
                                    <div class="meal-macros">
                                        <span class="badge badge-secondary">Open planner to add one</span>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('meal-planner') }}" class="btn btn-ghost btn-sm">View →</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between;">
                <span style="font-size:.85rem;color:var(--text-secondary);">Daily total: <strong style="color:var(--primary);">{{ number_format((int) ($dailyCalories ?? 0)) }} kcal</strong></span>
                <a href="{{ route('grocery-list') }}" class="btn btn-secondary btn-sm">🛒 View Grocery List</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>📅 Weekly Meal Plan</h4>
                <a href="{{ route('meal-planner') }}" class="btn btn-outline btn-sm">View Full Planner →</a>
            </div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:12px;">
                    @foreach (($weeklyPlanDays ?? []) as $day)
                        <div style="border:1px solid var(--border-light);border-radius:var(--radius-sm);padding:12px;">
                            <div style="font-weight:700;margin-bottom:10px;">{{ $day['day'] }}</div>
                            <div style="display:flex;flex-direction:column;gap:8px;">
                                @foreach (($day['meals'] ?? []) as $meal)
                                    @php
                                        $slot = (string) ($meal['slot'] ?? '');
                                        $recipe = $meal['recipe'] ?? null;
                                        $servings = (int) ($meal['servings'] ?? 1);
                                        $slotLabel = match ($slot) {
                                            'breakfast' => 'Breakfast',
                                            'lunch' => 'Lunch',
                                            'dinner' => 'Dinner',
                                            default => ucfirst($slot),
                                        };
                                    @endphp
                                    <div style="font-size:.82rem;line-height:1.45;">
                                        <strong>{{ $slotLabel }}:</strong>
                                        @if ($recipe)
                                            {{ $recipe->title }} <span style="color:var(--text-secondary);">× {{ $servings }}</span>
                                        @else
                                            <span style="color:var(--text-muted);">No meal planned</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h4>⚡ Quick Actions</h4></div>
            <div class="card-body" style="display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('browse-recipes') }}" class="quick-action-btn">🔍 Search Recipes</a>
                <a href="{{ route('meal-planner') }}" class="quick-action-btn">📅 Plan This Week</a>
                <a href="{{ route('grocery-list') }}" class="quick-action-btn">🛒 Generate Grocery List</a>
                <a href="{{ route('add-recipe') }}" class="quick-action-btn">🤖 Add AI Recipe</a>
                <a href="{{ route('business') }}" class="quick-action-btn">🏪 Local Businesses</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h4>📊 This Week</h4></div>
            <div class="card-body">
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div>
                        <div style="display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:4px;">
                            <span>Meals Planned</span>
                            <span style="font-weight:700;">{{ (int) ($weeklyMealsPlannedCount ?? 0) }}/21</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:{{ (int) ($mealCompletionPercent ?? 0) }}%;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:4px;">
                            <span>Grocery Ready</span>
                            <span style="font-weight:700;">{{ number_format((int) ($weeklyIngredientItemsCount ?? 0)) }} items</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:{{ (int) ($groceryReadyPercent ?? 0) }}%;background:var(--secondary);"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:4px;">
                            <span>Avg Calories</span>
                            <span style="font-weight:700;">{{ number_format((int) ($avgDailyCalories ?? 0)) }} / {{ number_format((int) ($calorieGoal ?? 2000)) }}</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:{{ (int) ($calorieGoalPercent ?? 0) }}%;background:var(--accent);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>🛒 Grocery List</h4>
                <a href="{{ route('grocery-list') }}" class="btn btn-outline btn-sm">Open List →</a>
            </div>
            <div class="card-body">
                <p style="font-size:.84rem;color:var(--text-secondary);margin-bottom:12px;">
                    Ingredients pulled from your weekly planned meals.
                </p>
                @if (filled(collect($groceryIngredients ?? [])))
                    <div style="display:flex;flex-wrap:wrap;gap:8px;">
                        @foreach (($groceryIngredients ?? []) as $ingredient)
                            <span class="badge badge-light" style="font-size:.82rem;padding:8px 10px;">
                                {{ $ingredient['name'] }} × {{ $ingredient['count'] }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state" style="padding:18px 12px;">
                        <div class="empty-icon">🛒</div>
                        <h4 style="margin-bottom:4px;">No groceries yet</h4>
                        <p style="margin-bottom:0;">Add meals to your planner to build this list.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mb-6">
    <div class="card-header">
        <h4>🔥 Trending Recipes</h4>
        <a href="{{ route('browse-recipes') }}" class="btn btn-outline btn-sm">Browse All →</a>
    </div>
    <div class="card-body">
        <div class="grid-4">
            @forelse (($trendingRecipes ?? []) as $recipe)
                @php
                    $dishTypes = is_array($recipe->dish_types) ? $recipe->dish_types : [];
                    $primaryCategory = count($dishTypes) > 0 ? (string) $dishTypes[0] : 'General';
                @endphp
                <div class="recipe-card" onclick="window.location.href='{{ route('browse-recipes') }}'">
                    <div class="recipe-thumb" style="background:linear-gradient(135deg,#D8F3DC,#B7E4C7);">
                        @if (filled($recipe->image))
                            <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" style="width:100%;height:100%;object-fit:cover;border-radius:inherit;">
                        @else
                            🍽️
                        @endif
                        <button class="bookmark" onclick="event.stopPropagation()">🔖</button>
                        <span class="badge badge-secondary category-badge">{{ \Illuminate\Support\Str::headline($primaryCategory) }}</span>
                    </div>
                    <div class="recipe-info">
                        <div class="recipe-title">{{ $recipe->title }}</div>
                        <div class="recipe-meta">
                            <span>⏱️ {{ $recipe->ready_in_minutes ? $recipe->ready_in_minutes.'m' : 'N/A' }}</span>
                            <span>👥 {{ $recipe->servings ?: 'N/A' }}</span>
                            <span>🥗 {{ \Illuminate\Support\Str::headline($primaryCategory) }}</span>
                        </div>
                        <div class="recipe-footer">
                            <div class="recipe-rating">
                                <span class="stars">⭐</span>
                                <span>FoodFork</span>
                            </div>
                            <span class="badge badge-primary">{{ $recipe->calories ? $recipe->calories.' kcal' : 'N/A kcal' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p style="font-size:.88rem;color:var(--text-secondary);grid-column:1/-1;">No trending recipes available yet.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="local-biz-banner">
    <div class="biz-banner-content">
        <div class="biz-banner-icon">🏪</div>
        <div>
            <h4>Local Businesses Near KT21</h4>
            <p>Discover butchers, fishmongers, and specialty shops in your area. Fresh ingredients delivered fast!</p>
        </div>
    </div>
    <a href="{{ route('business') }}" class="btn btn-secondary">Explore Local →</a>
</div>
@endsection

@push('styles')
<style>
  .today-meal {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 12px;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border-light);
    transition: var(--transition);
  }
  .today-meal:hover { background: var(--border-light); }
  .meal-time { font-size: .8rem; font-weight: 700; color: var(--text-secondary); width: 80px; flex-shrink: 0; }
  .meal-detail { flex: 1; }
  .meal-name { font-weight: 600; font-size: .9rem; margin-bottom: 6px; }
  .meal-macros { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
  .quick-action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border-radius: var(--radius-sm);
    border: 1.5px solid var(--border);
    font-size: .88rem;
    font-weight: 600;
    color: var(--text-primary);
    transition: var(--transition);
  }
  .quick-action-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: #f0fff4;
  }
  .local-biz-banner {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
    color: #fff;
    border-radius: var(--radius-lg);
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
  }
  .biz-banner-content { display: flex; align-items: center; gap: 20px; }
  .biz-banner-icon { font-size: 2.5rem; flex-shrink: 0; }
  .local-biz-banner h4 { color: #fff; margin-bottom: 4px; }
  .local-biz-banner p { color: rgba(255,255,255,.75); font-size: .88rem; margin: 0; }
  @media (max-width: 768px) {
    .dash-cols { grid-template-columns: 1fr !important; }
    .local-biz-banner { flex-direction: column; }
  }
</style>
@endpush
