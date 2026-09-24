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

            <!-- TICKER -->

            <div class="container-fluid mb-12">

                <div class="ticker">
                    <div class="ticker-inner">
                        <span class="ticker-word pink">TOKO</span>
                        <span class="ticker-word yellow">JUALAN</span>
                        <span class="ticker-word cream">AISYAH</span>
                        <span class="ticker-word pink">BERKUALITAS</span>
                        <span class="ticker-word yellow">BAIK</span>
                        <span class="ticker-word cream">DAN</span>
                        <span class="ticker-word pink">BAGUS</span>
                        <span class="ticker-sep">✦</span>
                        <span class="ticker-word yellow">TOKO</span>
                        <span class="ticker-word pink">JUALAN</span>
                        <span class="ticker-word cream">AISYAH</span>
                        <span class="ticker-word yellow">BERKUALITAS</span>
                        <span class="ticker-word pink">BAIK</span>
                        <span class="ticker-word cream">DAN</span>
                        <span class="ticker-word yellow">BAGUS</span>
                        <span class="ticker-sep">✦</span>
                        <span class="ticker-word pink">TOKO</span>
                        <span class="ticker-word yellow">JUALAN</span>
                        <span class="ticker-word cream">AISYAH</span>
                        <span class="ticker-word pink">BERKUALITAS</span>
                        <span class="ticker-word yellow">BAIK</span>
                        <span class="ticker-word cream">DAN</span>
                        <span class="ticker-word pink">BAGUS</span>
                        <span class="ticker-sep">✦</span>
                        <span class="ticker-word yellow">MY</span>
                        <span class="ticker-word pink">MILKSHAKE</span>
                        <span class="ticker-word cream">BRINGS</span>
                        <span class="ticker-word yellow">ALL THE</span>
                        <span class="ticker-word pink">BOYS</span>
                        <span class="ticker-word cream">TO THE</span>
                        <span class="ticker-word yellow">YARD</span>
                        <span class="ticker-sep">✦</span>
                    </div>
                </div>

            </div>

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
