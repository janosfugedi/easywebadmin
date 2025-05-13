@extends('layouts.base')

@section('title', 'Összhangban a belső világoddal')

@section('content')
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold mb-4 animate-fade">Schuster Judit - Biohacker</h1>
        <p class="text-lg max-w-2xl mx-auto animate-slide">
            A biohacking az emberi teljesítmény és jólét maximalizálásának művészete, ahol tudomány és önfejlesztés találkozik.
            Képzeld el, hogy egyszerű életmódbeli trükkökkel, mint például alvásoptimalizálás, étrendi finomhangolás vagy futurisztikus eszközök használata,
            felturbózod az energiád és meghosszabbítod az életed! Ez nem sci-fi, hanem a jövő kézikönyve, amely ma már bárki számára elérhető.
        </p>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-10 py-12">
        <div>
            <h2 class="text-2xl font-semibold mb-2">A módszerről</h2>
            <p>Egyszerű életmódbeli trükkökkel, mint például alvásoptimalizálás, étrendi finomhangolás vagy futurisztikus eszközök használata,
                felturbózod az energiád és meghosszabbítod az életed!</p>
        </div>
        <div>
            <h2 class="text-2xl font-semibold mb-2">Magadra ismersz?</h2>
            <ul class="list-disc list-inside">
                <li>Gyakori fejfájás</li>
                <li>Indokolatlan kimerültség</li>
                <li>Problémás látás</li>
                <li>Sikertelen diéta</li>
            </ul>
            <a href="{{ route('test') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 animate-bounce">Töltsd ki az állapotfelmérő tesztet</a>
        </div>
    </section>

    <section class="py-12 border-t">
        <h2 class="text-2xl font-semibold mb-4">Rólam</h2>
        <p>Gyermekkorom óta életem szerves részét képezi a sport: 10 éves koromtól kezdve harcművészettel foglalkozom.
            Polgári szakmámat tekintve edző és üzletasszony vagyok, azonban mindig foglalkoztatott egy bizonyos kérdés:
            hasonló erőforrások birtokában egyes emberek miért lesznek sikeresek, mások pedig miért buknak el?
            Ez a kíváncsiság indított el a biohacking útján.</p>
    </section>

    <section class="py-12 border-t">
        <h2 class="text-2xl font-semibold mb-4">Töltsd ki a tesztet!</h2>
        <p>Töltsd ki a rövid állapotfelmérő tesztet, hogy megtudd, mi a problémád valós gyökere!</p>
        <a href="{{ route('test') }}" class="mt-4 inline-block px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700">Kezdjük el →</a>
    </section>
@endsection
