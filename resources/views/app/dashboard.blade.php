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
            <div class="value">12</div>
            <div class="label">Saved Recipes</div>
            <div class="change up">↑ 3 this week</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">📅</div>
        <div class="stat-info">
            <div class="value">5</div>
            <div class="label">Meals Planned</div>
            <div class="change up">↑ Mon-Wed done</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">🛒</div>
        <div class="stat-info">
            <div class="value">23</div>
            <div class="label">Grocery Items</div>
            <div class="change">Ready to order</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow">🔥</div>
        <div class="stat-info">
            <div class="value">7</div>
            <div class="label">Day Streak</div>
            <div class="change up">Keep it going!</div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;margin-bottom:24px;" class="dash-cols">
    <div class="card">
        <div class="card-header">
            <h4>📅 Today's Meal Plan</h4>
            <a href="{{ route('meal-planner') }}" class="btn btn-outline btn-sm">View Full Planner →</a>
        </div>
        <div class="card-body">
            <div style="display:flex;flex-direction:column;gap:12px;">
                <div class="today-meal">
                    <div class="meal-time">🌅 Breakfast</div>
                    <div class="meal-detail">
                        <div class="meal-name">Avocado Toast and Poached Eggs</div>
                        <div class="meal-macros">
                            <span class="badge badge-primary">320 kcal</span>
                            <span class="badge badge-secondary">18g protein</span>
                            <span style="font-size:.78rem;color:var(--text-muted);">25 min</span>
                        </div>
                    </div>
                    <a href="{{ route('browse-recipes') }}" class="btn btn-ghost btn-sm">View →</a>
                </div>
                <div class="today-meal">
                    <div class="meal-time">☀️ Lunch</div>
                    <div class="meal-detail">
                        <div class="meal-name">Grilled Chicken Caesar Salad</div>
                        <div class="meal-macros">
                            <span class="badge badge-primary">480 kcal</span>
                            <span class="badge badge-secondary">35g protein</span>
                            <span style="font-size:.78rem;color:var(--text-muted);">20 min</span>
                        </div>
                    </div>
                    <a href="{{ route('browse-recipes') }}" class="btn btn-ghost btn-sm">View →</a>
                </div>
                <div class="today-meal">
                    <div class="meal-time">🌙 Dinner</div>
                    <div class="meal-detail">
                        <div class="meal-name">Beef Stir Fry with Noodles</div>
                        <div class="meal-macros">
                            <span class="badge badge-primary">610 kcal</span>
                            <span class="badge badge-secondary">42g protein</span>
                            <span style="font-size:.78rem;color:var(--text-muted);">35 min</span>
                        </div>
                    </div>
                    <a href="{{ route('browse-recipes') }}" class="btn btn-ghost btn-sm">View →</a>
                </div>
            </div>
        </div>
        <div class="card-footer" style="display:flex;align-items:center;justify-content:space-between;">
            <span style="font-size:.85rem;color:var(--text-secondary);">Daily total: <strong style="color:var(--primary);">1,410 kcal</strong></span>
            <a href="{{ route('grocery-list') }}" class="btn btn-secondary btn-sm">🛒 View Grocery List</a>
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
                            <span style="font-weight:700;">5/21</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:24%;"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:4px;">
                            <span>Grocery Ready</span>
                            <span style="font-weight:700;">23 items</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:60%;background:var(--secondary);"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:4px;">
                            <span>Avg Calories</span>
                            <span style="font-weight:700;">1,410 / 2,000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width:70%;background:var(--accent);"></div>
                        </div>
                    </div>
                </div>
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
            <div class="recipe-card" onclick="window.location.href='{{ route('browse-recipes') }}'">
                <div class="recipe-thumb">
                    🍗
                    <button class="bookmark" onclick="event.stopPropagation()">🔖</button>
                    <span class="badge badge-secondary category-badge">Chicken</span>
                </div>
                <div class="recipe-info">
                    <div class="recipe-title">Lemon Herb Roast Chicken</div>
                    <div class="recipe-meta">
                        <span>⏱️ 1h 20m</span>
                        <span>👥 4</span>
                        <span>📊 Easy</span>
                    </div>
                    <div class="recipe-footer">
                        <div class="recipe-rating">
                            <span class="stars">★★★★★</span>
                            <span>(4.9)</span>
                        </div>
                        <span class="badge badge-primary">520 kcal</span>
                    </div>
                </div>
            </div>

            <div class="recipe-card" onclick="window.location.href='{{ route('browse-recipes') }}'">
                <div class="recipe-thumb" style="background:linear-gradient(135deg,#FDEBD0,#F8C8A0);">
                    🥩
                    <button class="bookmark" onclick="event.stopPropagation()">🔖</button>
                    <span class="badge badge-danger category-badge">Beef</span>
                </div>
                <div class="recipe-info">
                    <div class="recipe-title">Classic Beef Bolognese</div>
                    <div class="recipe-meta">
                        <span>⏱️ 45m</span>
                        <span>👥 6</span>
                        <span>📊 Med</span>
                    </div>
                    <div class="recipe-footer">
                        <div class="recipe-rating">
                            <span class="stars">★★★★★</span>
                            <span>(4.8)</span>
                        </div>
                        <span class="badge badge-primary">680 kcal</span>
                    </div>
                </div>
            </div>

            <div class="recipe-card" onclick="window.location.href='{{ route('browse-recipes') }}'">
                <div class="recipe-thumb" style="background:linear-gradient(135deg,#D0E8FF,#A8D8FF);">
                    🍜
                    <button class="bookmark" onclick="event.stopPropagation()">🔖</button>
                    <span class="badge badge-info category-badge">Chinese</span>
                </div>
                <div class="recipe-info">
                    <div class="recipe-title">Kung Pao Chicken Noodles</div>
                    <div class="recipe-meta">
                        <span>⏱️ 30m</span>
                        <span>👥 2</span>
                        <span>📊 Easy</span>
                    </div>
                    <div class="recipe-footer">
                        <div class="recipe-rating">
                            <span class="stars">★★★★☆</span>
                            <span>(4.7)</span>
                        </div>
                        <span class="badge badge-primary">450 kcal</span>
                    </div>
                </div>
            </div>

            <div class="recipe-card" onclick="window.location.href='{{ route('browse-recipes') }}'">
                <div class="recipe-thumb" style="background:linear-gradient(135deg,#FFF3CD,#FFE69C);">
                    🥓
                    <button class="bookmark" onclick="event.stopPropagation()">🔖</button>
                    <span class="badge badge-warning category-badge">Pork</span>
                </div>
                <div class="recipe-info">
                    <div class="recipe-title">Slow Braised Pork Belly</div>
                    <div class="recipe-meta">
                        <span>⏱️ 3h</span>
                        <span>👥 4</span>
                        <span>📊 Hard</span>
                    </div>
                    <div class="recipe-footer">
                        <div class="recipe-rating">
                            <span class="stars">★★★★★</span>
                            <span>(4.9)</span>
                        </div>
                        <span class="badge badge-primary">720 kcal</span>
                    </div>
                </div>
            </div>
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
