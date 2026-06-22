@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')

    <style>
        .table-container {
            margin: auto;
            background: #fff;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: flex-end;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .table-title {
            margin: 0;
            font-size: 24px;
            color: #1f2937;
        }

        .table-subtitle {
            margin: 6px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .table-summary {
            text-align: right;
            color: #374151;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 26px;
        }

        thead th {
            text-align: left;
            font-size: 13px;
            color: #555;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 14px 10px;
            color: #333;
            font-size: 15px;
            vertical-align: top;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: #f0f6ff;
        }

        table, th, td {
            border: none;
        }

        .ingredient-name {
            font-weight: 700;
            text-transform: capitalize;
        }

        .ingredient-total {
            font-weight: 600;
            color: #0f766e;
        }

        .ingredient-recipes {
            color: #6b7280;
            line-height: 1.6;
        }

        .empty-state {
            padding: 32px 16px;
            text-align: center;
            color: #6b7280;
        }
    </style>

    {{-- Table --}}
    <div class="table-container">
        <div class="table-header">
            <div>
                <h2 class="table-title">Weekly Grocery Ingredients</h2>
                <p class="table-subtitle">Grouped from the recipes in your current meal plan week starting {{ $weekStartLabel }}.</p>
            </div>
            <div class="table-summary">
                <div>{{ count($groceryItems ?? []) }} ingredient rows</div>
                <div>{{ (int) ($plannedRecipesCount ?? 0) }} planned recipes</div>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Total Needed</th>
                    <th>Recipes This Week</th>
                </tr>
            </thead>
            <tbody>
                @forelse (($groceryItems ?? []) as $item)
                    <tr>
                        <td class="ingredient-name">{{ $item['name'] }}</td>
                        <td class="ingredient-total">{{ $item['total'] !== '' ? $item['total'] : $item['occurrences'].' items' }}</td>
                        <td class="ingredient-recipes">{{ implode(', ', $item['recipes']) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty-state">No meals are planned for the current week yet, so there are no grocery ingredients to show.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- TICKER -->
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
@endsection

@push("styles")
    <style>
        :root {
            --hot-pink: #ff2d78;
            --electric-yellow: #ffe600;
            --lime: #b8ff00;
            --sky: #00d4ff;
            --dark: #1a1820;
            --cream: #fff8f0;
            --purple: #7c3aed;
        }

        .ticker .cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            background: var(--electric-yellow);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease, width 0.2s, height 0.2s;
            mix-blend-mode: difference;
            display: none;
        }
        .ticker .cursor.visible {
            display: block;
        }
        .ticker .cursor.big {
            width: 60px;
            height: 60px;
        }

        .ticker {
            background: var(--dark);
            overflow: hidden;
            white-space: nowrap;
            position: fixed;
            bottom: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }
        .ticker-inner {
            display: inline-flex;
            align-items: center;
            animation: ticker 22s linear infinite;
        }
        .ticker-word {
            font-family: "Bebas Neue", sans-serif;
            font-size: 1.5rem;
            letter-spacing: 0.18em;
            padding: 12px 0;
            white-space: nowrap;
        }
        .ticker-word.pink {
            color: var(--hot-pink);
            padding-right: 28px;
        }
        .ticker-word.yellow {
            color: var(--electric-yellow);
            padding-right: 28px;
        }
        .ticker-word.cream {
            color: rgba(255, 248, 240, 0.25);
            padding-right: 28px;
        }
        .ticker-sep {
            color: var(--hot-pink);
            font-size: 1.2rem;
            padding: 0 20px 0 0;
            opacity: 0.5;
        }

        @keyframes ticker {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
    </style>
@endpush
