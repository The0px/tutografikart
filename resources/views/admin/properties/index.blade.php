@extends('admin.admin')

@section('title', 'Tout les biens')

@section('content')


    <div class="flex justify-between items-center">
        <h1 class="mb-4 text-3xl font-medium">@yield('title')</h1>
        <a href="{{ route('admin.property.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            Ajouter un bien
        </a>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="border-b">
                <th class="py-2">Titre</th>
                <th class="py-2">Surface</th>
                <th class="py-2">Prix</th>
                <th class="py-2">Ville</th>
                <th class="py-2 text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr class="border-b">
                    <td class="py-2">{{ $property->title }}</td>
                    <td class="py-2">{{ $property->surface }}m²</td>
                    <td class="py-2">{{ number_format($property->price, thousands_separator: ' ') }}</td>
                    <td class="py-2">{{ $property->city }}</td>
                    <td class="py-2">
                        <div class="flex gap-2 w-full justify-end">
                            <a href="{{ route('admin.property.edit', $property) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Editer</a>
                            @can("delete", $property)
                                <form action="{{ route('admin.property.destroy', $property) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Supprimer</button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $properties->links() }}

@endsection
