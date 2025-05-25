@extends('theme::layout')
@section('content')
    @foreach ($regions as $region => $blockIds)
        @includeIf('components.region', ['blocks' => $blocks[$region]])
    @endforeach
@endsection
