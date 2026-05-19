@extends('layouts.auth', ['title' => 'FoodFork — Login / Register'])

@section('content')
<div class="auth-left">
    <div class="auth-brand">
        <div class="brand-logo">🍴</div>
        <h1>Food<span>Fork</span></h1>
        <p>Plan your meals, discover recipes, and get your groceries delivered.</p>
    </div>

    <div class="auth-features">
        <div class="feature-item"><span class="feature-icon">🍽️</span><div><h5>500+ Recipes</h5><p>Chicken, Beef, Chinese, Vegetarian and more</p></div></div>
        <div class="feature-item"><span class="feature-icon">📅</span><div><h5>Weekly Meal Planner</h5><p>Plan breakfast, lunch and dinner for the full week</p></div></div>
        <div class="feature-item"><span class="feature-icon">🛒</span><div><h5>Smart Grocery List</h5><p>Auto-generated shopping list from your meal plan</p></div></div>
        <div class="feature-item"><span class="feature-icon">🤖</span><div><h5>AI-Powered</h5><p>AI search and recipe enrichment</p></div></div>
    </div>

    <div class="auth-quote">
        <blockquote>"Good food is the foundation of genuine happiness."</blockquote>
        <cite>— Auguste Escoffier</cite>
    </div>
</div>

<div class="auth-right">
    <div class="auth-card">
        <div class="auth-tabs">
            <button class="auth-tab active" onclick="switchTab('login', this)">Sign In</button>
            <button class="auth-tab" onclick="switchTab('register', this)">Create Account</button>
        </div>

        <div id="login" class="auth-form active">
            <div class="auth-header">
                <h2>Welcome back! 👋</h2>
                <p>Sign in to access your recipes and meal plans</p>
            </div>
            <form onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-icon"><span class="icon">📧</span><input type="email" class="form-control" placeholder="you@example.com" required /></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-icon" style="position:relative;"><span class="icon">🔒</span><input id="loginPassword" type="password" class="form-control" placeholder="••••••••" required /><button type="button" class="pwd-toggle" onclick="togglePwd('loginPassword', this)">👁️</button></div>
                </div>
                <button type="submit" class="btn btn-primary w-full btn-lg">Sign In →</button>
            </form>
        </div>

        <div id="register" class="auth-form">
            <div class="auth-header">
                <h2>Join FoodFork 🍴</h2>
                <p>Create your free account in seconds</p>
            </div>
            <form onsubmit="handleRegister(event)">
                <div class="grid-2" style="gap:12px;">
                    <div class="form-group" style="margin-bottom:0"><label class="form-label">First Name</label><input type="text" class="form-control" placeholder="Jane" required /></div>
                    <div class="form-group" style="margin-bottom:0"><label class="form-label">Last Name</label><input type="text" class="form-control" placeholder="Doe" required /></div>
                </div>
                <div class="form-group mt-4"><label class="form-label">Email Address</label><div class="input-icon"><span class="icon">📧</span><input type="email" class="form-control" placeholder="you@example.com" required /></div></div>
                <button type="submit" class="btn btn-primary w-full btn-lg">Create Account →</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function switchTab(id, el) {
        document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.auth-form').forEach(f => f.classList.remove('active'));
        el.classList.add('active');
        document.getElementById(id).classList.add('active');
    }

    function togglePwd(id, btn) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.textContent = input.type === 'password' ? '👁️' : '🙈';
    }

    function handleLogin(e) {
        e.preventDefault();
        showToast('Signed in successfully', 'success');
        window.location.href = '{{ route('dashboard') }}';
    }

    function handleRegister(e) {
        e.preventDefault();
        showToast('Account created successfully', 'success');
        window.location.href = '{{ route('dashboard') }}';
    }
</script>
@endsection
