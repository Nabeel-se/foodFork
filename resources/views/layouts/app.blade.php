@php
    $pageTitle = $title ?? 'FoodFork - Dashboard';
    $activeKey = $active ?? 'dashboard';
    $showSearchBar = $showSearch ?? true;
    $topbarHeading = $topbarTitle ?? 'Dashboard';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>

    @vite(['resources/css/theme-style.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="app-wrapper">
        <x-app.sidebar :active="$activeKey" />

        <div class="main-content">
            <x-app.topbar :title="$topbarHeading" :showSearch="$showSearchBar" />

            <main class="page-body">
                @yield('content')
            </main>
        </div>
    </div>

    @yield("modals")

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        if (window.innerWidth <= 768) {
            const menuBtn = document.getElementById('menuBtn');
            if (menuBtn) {
                menuBtn.style.display = 'flex';
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
