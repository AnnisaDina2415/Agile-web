<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.jpeg') }}" type="image/x-icon">
    <title>@yield('title', 'ReGoods')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F5F5F5; color: #212121; }
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen antialiased">

    @include('partials.navbar-pembeli')

    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    @stack('scripts')
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>