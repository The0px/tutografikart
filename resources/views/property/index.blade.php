@extends('base')

@section('title', 'tous les biens')

@section('content')

    <div class="mb-5 bg-white p-5 text-center">
        <form action="" method="get" class="container mx-auto flex flex-col gap-2 px-4 md:flex-row md:items-center">
            <input type="number" placeholder="Surface minimum" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="surface" value="{{ $input['surfaces'] ?? '' }}">
            <input type="number" placeholder="Nombre de pièces minimum" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="surface" value="{{ $input['rooms'] ?? '' }}">
            <input type="number" placeholder="Budget max" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="price" value="{{ $input['price'] ?? '' }}">
            <input placeholder="Mot clef" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" name="title" value="{{ $input['title'] ?? '' }}">
            <button class="shrink-0 rounded-md bg-indigo-500 px-4 py-2 text-white hover:bg-indigo-600">
                Rechercher
            </button>
        </form>

    </div>


    <div class="container mx-auto px-4">
        <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($properties as $property)
                    @include('property.card')
                @empty
                    <p class="col-span-full text-gray-700">Aucun bien trouvé</p>
                @endforelse
        </div>

        <div class="my-4">
            {{ $properties->links() }}
        </div>
    </div>


@endsection
