<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'FoodFork — Login' }}</title>
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('theme/css/auth.css') }}" />
</head>
<body class="auth-body">
    @yield('content')

    <div class="toast-container" id="toastContainer"></div>

    <script>
        function showToast(msg, type = '') {
            const c = document.getElementById('toastContainer');
            const el = document.createElement('div');
            el.className = 'toast' + (type ? ' ' + type : '');
            el.innerHTML = '<span>' + msg + '</span>';
            c.appendChild(el);
            setTimeout(() => el.classList.add('show'), 10);
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 220);
            }, 2600);
        }
    </script>

    @yield('scripts')
</body>
</html>
