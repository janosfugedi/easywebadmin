<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? '' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/assets/favicon.ico">
</head>
<body class="bg-white text-gray-800">

@foreach ($regions as $region => $blockIds)
    @includeIf('theme::components.region', ['blocks' => $blocks[$region]])
@endforeach

</body>
</html>
