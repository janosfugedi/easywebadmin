@if ($region == 'header')
    <header>
        <h1>{{ config('site.site_name') }}</h1>
    </header>
@endif

@if ($region == 'footer')
    <footer>
        <p>© {{ date('Y') }} - Laravel Theme rendszer</p>
    </footer>
@endif
