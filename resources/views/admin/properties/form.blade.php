@extends('admin.admin')

@section('title', $property->exists ? "Editer un bien" : "Créer un bien")

@section('content')

    <h1 class="mb-4 text-3xl font-medium">@yield('title')</h1>

    <form class="flex flex-col gap-4" action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post">

        @csrf
        @method($property->exists ? 'put' : 'post')

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            @include('admin.shared.input', ['class' => 'md:col-span-2', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title])
            @include('admin.shared.input', ['name' => 'surface', 'value' => $property->surface])
            @include('admin.shared.input', ['name' => 'price', 'label' => 'Prix', 'value' => $property->price])
        </div>

        @include('admin.shared.input', ['type' => 'textarea', 'name' => 'description', 'value' => $property->description])

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @include('admin.shared.input', ['name' => 'rooms', 'label' => 'Pièces', 'value' => $property->rooms])
            @include('admin.shared.input', ['name' => 'bedrooms', 'label' => 'Chambres', 'value' => $property->bedrooms])
            @include('admin.shared.input', ['name' => 'floor', 'label' => 'Étage', 'value' => $property->floor])
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            @include('admin.shared.input', ['class' => 'md:col-span-2', 'name' => 'address', 'label' => 'Adresse', 'value' => $property->address])
            @include('admin.shared.input', ['name' => 'city', 'label' => 'Ville', 'value' => $property->city])
            @include('admin.shared.input', ['name' => 'postal_code', 'label' => 'Code postal', 'value' => $property->postal_code])
        </div>

        @include('admin.shared.select', ['name' => 'options', 'label' => 'Options', 'value' => $property->options()->pluck('id'), 'multiple' => true])
        @include('admin.shared.checkbox', ['name' => 'sold', 'label' => 'Vendu', 'value' => $property->sold, 'options' => $options])

        <div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-md">
                @if($property->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>

    </form>

@endsection
