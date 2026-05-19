<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FoodFork - Login</title>
    @vite(['resources/css/theme-style.css', 'resources/css/theme-auth.css'])
</head>
<body class="auth-body">
    <div class="auth-left">
        <div class="auth-brand">
            <div class="brand-logo">🍴</div>
            <h1>Food<span>Fork</span></h1>
            <p>Plan your meals, discover recipes, and get your groceries delivered.</p>
        </div>

        <div class="auth-features">
            <div class="feature-item">
                <span class="feature-icon">🍽️</span>
                <div>
                    <h5>500+ Recipes</h5>
                    <p>Chicken, Beef, Chinese, Vegetarian and more</p>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">📅</span>
                <div>
                    <h5>Weekly Meal Planner</h5>
                    <p>Plan breakfast, lunch and dinner for the full week</p>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">🛒</span>
                <div>
                    <h5>Smart Grocery List</h5>
                    <p>Auto-generated shopping list from your meal plan</p>
                </div>
            </div>
            <div class="feature-item">
                <span class="feature-icon">🤖</span>
                <div>
                    <h5>AI-Powered</h5>
                    <p>AI searches and recipe suggestions in one place</p>
                </div>
            </div>
        </div>

        <div class="auth-quote">
            <blockquote>"Good food is the foundation of genuine happiness."</blockquote>
            <cite>- Auguste Escoffier</cite>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-card">
            <div class="auth-tabs">
                <button class="auth-tab active" type="button">Sign In</button>
                <a class="auth-tab" href="{{ route('register') }}">Create Account</a>
            </div>

            <div class="auth-form active">
                <div class="auth-header">
                    <h2>Welcome back! 👋</h2>
                    <p>Sign in to access your recipes and meal plans</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-info mb-4">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <div class="input-icon">
                            <span class="icon">📧</span>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="you@example.com"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                            />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password" style="display:flex;justify-content:space-between;">
                            Password
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                            @endif
                        </label>
                        <div class="input-icon" style="position:relative;">
                            <span class="icon">🔒</span>
                            <input
                                type="password"
                                class="form-control"
                                placeholder="••••••••"
                                id="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                            <button type="button" class="pwd-toggle" onclick="togglePwd('password', this)">👁️</button>
                        </div>
                    </div>

                    <div class="form-group" style="display:flex;align-items:center;gap:8px;">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            style="width:16px;height:16px;accent-color:var(--primary);"
                            {{ old('remember') ? 'checked' : '' }}
                        />
                        <label for="remember" style="font-size:.88rem;color:var(--text-secondary);cursor:pointer;">Remember me for 30 days</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-full btn-lg" style="margin-top:4px;">
                        Sign In →
                    </button>
                </form>

                <p class="auth-switch">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create one free →</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        function togglePwd(id, btn) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.textContent = input.type === 'password' ? '👁️' : '🙈';
        }
    </script>
</body>
</html>
