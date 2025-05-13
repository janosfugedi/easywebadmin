@extends('layouts.base')

@section('title', 'Biohacking módszer – Schuster Judit')

@section('content')
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold mb-6 animate-fade">Mi az a biohacking?</h1>
        <p class="max-w-3xl mx-auto text-lg leading-relaxed animate-slide">
            A biohacking az emberi teljesítmény és jólét optimalizálásának tudománya és művészete.
            Olyan tudatos beavatkozások összessége, melyek célja a fizikai és mentális teljesítmény fokozása,
            az energiaszint emelése, a stressz csökkentése és a hosszú távú egészség támogatása.
        </p>
    </section>

    <section class="py-12 border-t grid grid-cols-1 md:grid-cols-2 gap-10">
        <div>
            <h2 class="text-2xl font-semibold mb-4">Milyen eszközökkel dolgozom?</h2>
            <ul class="list-disc list-inside space-y-2">
                <li>Alvásoptimalizálás és cirkadián ritmus támogatása</li>
                <li>Étrend és tápanyag-beállítás (pl. személyre szabott kiegészítők)</li>
                <li>Légzéstechnika, meditáció, stresszkezelés</li>
                <li>Fizikai aktivitás: mozgás, sport, biofeedback</li>
                <li>Modern eszközök: okoseszközök, pulzusmérés, HRV-analízis</li>
            </ul>
        </div>
        <div>
            <h2 class="text-2xl font-semibold mb-4">Kinek való?</h2>
            <p>Mindazoknak, akik:
            <ul class="list-disc list-inside mt-2">
                <li>fáradtnak, stresszesnek érzik magukat</li>
                <li>jobb fókuszra, teljesítményre vágynak</li>
                <li>meg akarják érteni a testük működését</li>
                <li>célzott életmódbeli változásokkal akarnak javítani az életminőségükön</li>
            </ul>
            </p>
        </div>
    </section>

    <section class="py-12 text-center border-t">
        <h2 class="text-2xl font-semibold mb-4">Készen állsz optimalizálni az életed?</h2>
        <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Vedd fel velem a kapcsolatot</a>
    </section>
@endsection
