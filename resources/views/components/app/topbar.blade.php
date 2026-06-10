@props([
    'title' => 'Dashboard',
    'showSearch' => true,
    'searchInputId' => 'globalRecipeSearchInput',
    'enableDefaultSearchRedirect' => true,
])

@php
    $name = auth()->user()?->name ?? 'Guest User';
    $initials = collect(explode(' ', trim($name)))
        ->filter()
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
    $initials = $initials !== '' ? $initials : 'GU';
@endphp

<header class="topbar">
    <button class="btn btn-ghost btn-icon" onclick="toggleSidebar()" style="display:none;margin-right:8px;" id="menuBtn">☰</button>

    @if ($showSearch)
        <div class="topbar-search">
            <span>🔍</span>
            <input
                id="{{ $searchInputId }}"
                name="recipe_search"
                type="text"
                placeholder="Search recipes, ingredients..."
                onkeydown="if(event.key==='Enter' && {{ $enableDefaultSearchRedirect ? 'true' : 'false' }}) { const query = this.value.trim(); const baseUrl = '{{ route('browse-recipes') }}'; window.location.href = query ? `${baseUrl}?search=${encodeURIComponent(query)}` : baseUrl; }"
            />
        </div>
    @else
        <span class="topbar-title">{{ $title }}</span>
    @endif

    <div class="topbar-actions" style="margin-left:auto;">
        <button class="icon-btn" title="Notifications">
            🔔
            <span class="dot"></span>
        </button>
        <a href="{{ route('profile.edit') }}">
            <div class="avatar" style="cursor:pointer;">{{ $initials }}</div>
        </a>
    </div>
</header>
