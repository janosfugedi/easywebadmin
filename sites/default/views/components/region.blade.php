@foreach($blocks ?? [] as $block)
    @include('blocks.' . $block['type'],
     ['data' => $block['data'] ?? []])
@endforeach
