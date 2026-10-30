@extends('admin.admin')

@section('title', $option->exists ? "Editer une option" : "Créer une option")

@section('content')

    <h1 class="mb-4 text-3xl font-medium">@yield('title')</h1>

    <form class="flex flex-col gap-4" action="{{ route($option->exists ? 'admin.option.update' : 'admin.option.store', $option) }}" method="post">

        @csrf
        @method($option->exists ? 'put' : 'post')


        @include('admin.shared.input', ['name' => 'name', 'label' => 'Nom', 'value' => $option->name])

        <div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md">
                @if($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection
