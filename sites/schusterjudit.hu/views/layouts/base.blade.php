<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Schuster Judit | Biohacker')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- @-vite(['resources/css/app.css']) {{-- ha Tailwind megy --}} -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-gray-800 bg-white">
<header class="p-4 shadow-md flex justify-between">
    <a href="{{ route('home') }}" class="font-bold text-xl">Schuster Judit</a>
    <nav class="space-x-4">
        <a href="{{ route('biohacking') }}">Biohacking</a>
        <a href="{{ route('about') }}">Rólam</a>
        <a href="{{ route('test') }}">Teszt</a>
        <a href="{{ route('blog') }}">Blog</a>
        <a href="{{ route('contact') }}">Kapcsolat</a>
    </nav>
</header>

<main class="p-6">
    @yield('content')
</main>

@include('components.footer')
</body>
</html>
