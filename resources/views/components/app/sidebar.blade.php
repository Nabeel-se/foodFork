@php
    $active = $active ?? 'dashboard';

    $items = [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'icon' => '🏠', 'route' => 'dashboard'],
        ['key' => 'browse', 'label' => 'Browse Recipes', 'icon' => '🔍', 'route' => 'browse-recipes', 'badge' => '500+'],
        ['key' => 'planner', 'label' => 'Meal Planner', 'icon' => '📅', 'route' => 'meal-planner'],
        ['key' => 'grocery', 'label' => 'Grocery List', 'icon' => '🛒', 'route' => 'grocery-list'],
        ['key' => 'add-recipe', 'label' => 'Add Recipe', 'icon' => '➕', 'route' => 'add-recipe'],
    ];

    $accountItems = [
        ['key' => 'profile', 'label' => 'My Profile', 'icon' => '👤', 'route' => 'profile.edit'],
        ['key' => 'business', 'label' => 'Local Businesses', 'icon' => '🏪', 'route' => 'business'],
    ];

    $user = auth()->user();
    $displayName = $user?->name ?? 'Guest User';
    $initials = collect(explode(' ', trim($displayName)))
        ->filter()
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
    $initials = $initials !== '' ? $initials : 'GU';
@endphp

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">🍴</div>
        <span class="logo-text">Food<span>Fork</span></span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Main</div>

        @foreach ($items as $item)
            <a href="{{ route($item['route']) }}" class="nav-item {{ $active === $item['key'] ? 'active' : '' }}">
                <span class="nav-icon">{{ $item['icon'] }}</span> {{ $item['label'] }}
                @if (!empty($item['badge']))
                    <span class="nav-badge">{{ $item['badge'] }}</span>
                @endif
            </a>
        @endforeach

        <div class="nav-section" style="margin-top:12px;">Account</div>
        @foreach ($accountItems as $item)
            <a href="{{ route($item['route']) }}" class="nav-item {{ $active === $item['key'] ? 'active' : '' }}">
                <span class="nav-icon">{{ $item['icon'] }}</span> {{ $item['label'] }}
            </a>
        @endforeach

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-item" style="width:100%;text-align:left;">
                <span class="nav-icon">🚪</span> Sign Out
            </button>
        </form>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="avatar">{{ $initials }}</div>
            <div class="sidebar-user-info">
                <div class="name">{{ $displayName }}</div>
                <div class="role">KT21 · Free Plan</div>
            </div>
        </div>
    </div>
</aside>
