@extends('admin.admin')

@section('title', 'Toutes les options')

@section('content')


    <div class="flex justify-between items-center">
        <h1 class="mb-4 text-3xl font-medium">@yield('title')</h1>
        <a href="{{ route('admin.option.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            Ajouter une option
        </a>
    </div>

    <table class="w-full text-left">
        <thead>
            <tr class="border-b">
                <th class="py-2">Nom</th>
            </tr>
        </thead>
        <tbody>
            @foreach($options as $option)
                <tr class="border-b">
                    <td class="py-2">{{ $option->name }}</td>
                    <td class="py-2">
                        <div class="flex gap-2 w-full justify-end">
                            <a href="{{ route('admin.option.edit', $option) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Editer</a>
                            <form action="{{ route('admin.option.destroy', $option) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $options->links() }}

@endsection
