@extends('layouts.app', [
    'title' => $title,
    'active' => $active,
    'showSearch' => false,
    'topbarTitle' => $topbarTitle,
])

@section('content')
<div class="page-header">
    <h2>{{ $topbarTitle }}</h2>
    <p>This page is wired into Laravel layout/components and ready for full content migration from your theme.</p>
</div>

<div class="card">
    <div class="card-body" style="padding:28px;">
        <h4 style="margin-bottom:8px;">Reusable foundation is ready</h4>
        <p>Sidebar, topbar, responsive menu, shared toasts, and theme styles are all centralized so the next pages can be dropped in quickly.</p>
        <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap;">
            <a class="btn btn-outline" href="{{ route('dashboard') }}">Go to Dashboard</a>
            <a class="btn btn-primary" href="{{ route('browse-recipes') }}">Continue Setup</a>
        </div>
    </div>
</div>
@endsection
