<!-- resources/views/pages/contact.blade.php -->
@extends('layouts.base')

@section('title', 'Kapcsolat – Schuster Judit')

@section('content')
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold mb-6 animate-fade">Kapcsolat</h1>
        <p class="text-lg max-w-2xl mx-auto mb-8">Kérdésed van? Töltsd ki az űrlapot, vagy keress az alábbi elérhetőségek egyikén!</p>

        <div class="max-w-2xl mx-auto text-left">
            <form action="#" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block font-semibold">Név</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label for="email" class="block font-semibold">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2">
                </div>
                <div>
                    <label for="message" class="block font-semibold">Üzenet</label>
                    <textarea id="message" name="message" rows="5" class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Üzenet küldése</button>
            </form>

            <div class="mt-12 text-sm text-gray-600">
                <p><strong>Email:</strong> info.schusterjudit@gmail.com</p>
                <p><strong>Telefon:</strong> +36 30 824 6980</p>
                <p><strong>Cím:</strong> 3527 Miskolc, Bajcsy Zsilinszky u. 17</p>
            </div>
        </div>
    </section>
@endsection
