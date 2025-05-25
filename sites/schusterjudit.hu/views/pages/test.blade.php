@extends('theme::layout')
@section('title', 'Állapotfelmérő teszt – Schuster Judit')

@section('content')
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold mb-6 animate-fade">Töltsd ki az állapotfelmérő tesztet</h1>
        <p class="text-lg max-w-2xl mx-auto mb-10 animate-slide">
            A teszt kitöltése segít feltérképezni aktuális energiaszinted és egészségi állapotod.
        </p>

        <div class="w-full max-w-2xl mx-auto aspect-[3/4]">
            <iframe
                src="https://form.typeform.com/to/k9wkzwgF?typeform-embed-id=07159152520646561&typeform-embed=embed-widget&typeform-source=www-schusterjudit-hu.filesusr.com&typeform-medium=snippet&typeform-medium-version=next&embed-opacity=100&typeform-embed-handles-redirect=1"
                class="w-full h-full border-none rounded shadow-md"
                allow="camera; microphone; autoplay; encrypted-media;"
            ></iframe>
        </div>
    </section>
@endsection
