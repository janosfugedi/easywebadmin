<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>{{ config('site.site_name') }}</title>
    <link rel="stylesheet" href="{{ asset('themes/' . config('site.theme') . '/css/style.css') }}">
</head>
<body>

@include('theme::region', ['region' => 'header'])

<main>default
    @yield('content')
</main>

@include('theme::region', ['region' => 'footer'])

</body>
</html>
