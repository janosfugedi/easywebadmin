<footer class="bg-[#ffd8fd] text-gray-700 py-10 border-t border-white/20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">

        <div>
            <img src="{{ $data['profile_image'] ?? '/placeholder.jpg' }}" alt="Profilkép" class="w-16 h-16 rounded-full mb-2">
            <div class="font-bold text-lg text-rose-800">{{ $data['name'] ?? 'Név' }}</div>
            <div class="text-gray-700">{{ $data['subtitle'] ?? '' }}</div>
            <div class="text-gray-600 mt-2 text-xs">{{ $data['note'] ?? '' }}</div>
        </div>

        @if (!empty($data['form_enabled']))
            <div>
                <h3 class="font-semibold mb-2">Levél küldése</h3>
                <form action="{{ $data['form_action'] ?? '#' }}" method="POST" class="space-y-2">
                    <input type="text" name="name" placeholder="Név" class="w-full px-4 py-2 rounded border">
                    <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 rounded border">
                    <textarea name="message" rows="3" placeholder="Üzenet" class="w-full px-4 py-2 rounded border"></textarea>
                    <button type="submit" class="mt-2 bg-rose-600 text-white px-4 py-2 rounded hover:bg-rose-700">Küldés</button>
                </form>
            </div>
        @endif

        <div>
            <h3 class="font-semibold mb-2">Elérhetőségeim</h3>
            <ul class="space-y-1">
                <li>📍 {{ $data['address'] ?? '-' }}</li>
                <li>📞 {{ $data['phone'] ?? '-' }}</li>
                <li>✉️ <a href="mailto:{{ $data['email'] }}" class="underline">{{ $data['email'] }}</a></li>
                <li>💻 {{ $data['service'] ?? '' }}</li>
            </ul>
        </div>
    </div>

    <div class="text-center text-xs text-gray-600 mt-8">
        &copy; {{ date('Y') }} {{ $data['name'] ?? 'Név' }}. Minden jog fenntartva.
    </div>
</footer>
