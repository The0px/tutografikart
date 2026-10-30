@extends('base')

@section('title', 'Accueil')

@section('content')

    <x-weather>

    </x-weather>

    <section class="bg-gray-300 py-16 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-semibold text-gray-900">Agence</h1>
        </div>
    </section>

    <section class="container mx-auto px-4 py-10">
        <h2 class="mb-6 text-2xl font-semibold text-gray-900">Nos derniers biens</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($properties as $property)
                @include('property.card')
            @endforeach
        </div>
    </section>
@endsection
