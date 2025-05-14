<section class="py-20 bg-rose-50 text-center px-4">
    <div class="max-w-xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">{{ $data['title'] ?? 'Töltsd ki a tesztet!' }}</h2>
        <p class="text-lg text-gray-600 mb-6">{{ $data['text'] ?? 'Néhány egyszerű kérdés segít feltérképezni az aktuális állapotod.' }}</p>
        @if (!empty($data['button_text']) && !empty($data['button_link']))
            <a href="{{ $data['button_link'] }}" class="inline-block bg-rose-600 text-white px-6 py-3 rounded-full hover:bg-rose-700 transition">
                {{ $data['button_text'] }}
            </a>
        @endif
    </div>
</section>
