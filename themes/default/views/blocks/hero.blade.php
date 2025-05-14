<section class="relative bg-cover bg-center h-[80vh] flex items-center justify-center text-center text-white" style="background-image: url('{{ $data['image'] ?? '/images/default-hero.jpg' }}');">
    <div class="bg-black/50 w-full h-full absolute inset-0"></div>
    <div class="relative z-10 px-4">
        <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ $data['title'] ?? '' }}</h1>
        <p class="text-lg md:text-xl mb-6 drop-shadow-md max-w-2xl mx-auto">{{ $data['subtitle'] ?? '' }}</p>
        @if(!empty($data['cta_text']) && !empty($data['cta_link']))
            <a href="{{ $data['cta_link'] }}" class="inline-block bg-white/80 text-rose-700 font-semibold px-6 py-3 rounded-full hover:bg-white/90 transition">
                {{ $data['cta_text'] }}
            </a>
        @endif
    </div>
</section>
