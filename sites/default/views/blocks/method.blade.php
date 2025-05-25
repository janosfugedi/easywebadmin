<section class="py-16 bg-gray-50 px-4">
    <div class="max-w-5xl mx-auto text-center">
        <h2 class="text-3xl font-semibold mb-8 text-gray-800">{{ $data['title'] ?? '' }}</h2>
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left text-lg text-gray-700 max-w-3xl mx-auto">
            @foreach($data['items'] ?? [] as $item)
                <li class="flex items-start space-x-2">
                    <span class="text-rose-600 font-bold">&#8226;</span>
                    <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>
