<div class="region region-{{ $region }}">
    @foreach ($blocks as $block)
        @include("theme.basic.block", ['block' => $block])
    @endforeach
</div>
