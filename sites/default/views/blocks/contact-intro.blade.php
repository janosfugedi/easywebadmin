<section class="py-20 bg-white text-center px-4">
    <div class="max-w-xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">{{ $data['title'] ?? 'Kapcsolatfelvétel' }}</h2>
        <p class="text-lg text-gray-600 mb-6">{{ $data['text'] ?? 'Vedd fel velem a kapcsolatot emailen, telefonon vagy az alábbi űrlapon keresztül.' }}</p>

        <div class="text-left text-sm text-gray-700 mb-6">
            <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] ?? '' }}" class="underline">{{ $data['email'] ?? '' }}</a></p>
            <p><strong>Telefon:</strong> {{ $data['phone'] ?? '' }}</p>
            <p><strong>Cím:</strong> {{ $data['address'] ?? '' }}</p>
        </div>

        @if (!empty($data['button_text']) && !empty($data['button_link']))
            <a href="{{ $data['button_link'] }}" class="inline-block bg-rose-600 text-white px-6 py-3 rounded-full hover:bg-rose-700 transition">
                {{ $data['button_text'] }}
            </a>
        @endif
    </div>
</section>
