@foreach($blocks ?? [] as $block)
    @include('theme::blocks.' . $block['type'],
     ['data' => $block['data'] ?? []])
@endforeach
