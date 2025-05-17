<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>{{ $site->title }}</title>

    @foreach (json_decode($theme->assets)->css ?? [] as $css)
        <link rel="stylesheet" href="{{ $css }}">
    @endforeach
</head>
<body>

@foreach ($theme->regions as $region)
    <div id="region-{{ $region }}">
        @foreach ($blocks[$region] ?? [] as $block)
            @include("theme.basic.region", ['region' => $region, 'blocks' => $blocks])
        @endforeach
    </div>
@endforeach

@foreach (json_decode($theme->assets)->js ?? [] as $js)
    <script src="{{ $js }}"></script>
@endforeach
</body>
</html>
