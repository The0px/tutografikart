@extends('base')

@section('title', $property->title)

@section('content')

    <div class="container mx-auto mt-12 px-4">
    <h1 class="text-3xl font-semibold text-gray-900">{{ $property->title }}</h1>
    <h2 class="mt-2 text-xl text-gray-700">{{ $property->rooms }} pièces - {{ $property->surface }} m²</h2>

    <div class="mt-4 text-[4rem] font-bold leading-none text-gray-900">
        {{ number_format($property->price, thousands_separator: ' ') }} €
    </div>

    <hr class="my-8 border-gray-200">

    <div class="mt-4">
        <h4 class="mb-4 text-xl font-semibold text-gray-900">{{ __('property.contact_title') }}</h4>

        @include('admin.shared.flash')

        <form action="{{ route('property.contact', $property) }}" method="post" class="flex flex-col gap-4">
            @csrf
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @include('admin.shared.input', ['name' => 'firstname','label' => 'Prénom'])
                @include('admin.shared.input', ['name' => 'lastname','label' => 'Nom'])
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @include('admin.shared.input', ['name' => 'phone','label' => 'Téléphone'])
                @include('admin.shared.input', ['type' => 'email', 'name' => 'email','label' => 'Email'])
            </div>
            @include('admin.shared.input', ['type' => 'textarea', 'name' => 'message','label' => 'Votre message'])
            <div>
                <button class="mt-4 cursor-pointer rounded-md bg-blue-500 px-4 py-2 text-white">
                    Nous contacter
                </button>
            </div>
        </form>
    </div>


    <div class="mt-8">
        <p class="text-gray-800">{!! nl2br($property->description) !!}</p>
        <div class="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-12">
            <div class="lg:col-span-8">
                <h2 class="mb-4 text-2xl font-semibold text-gray-900">Caractéristiques</h2>
                <table class="w-full border-collapse text-left">
                    <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-2 pr-4 font-medium">Surface</td>
                        <td class="py-2">{{ $property->surface }} m²</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-medium">Pièces</td>
                        <td class="py-2">{{ $property->rooms }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-medium">Chambres</td>
                        <td class="py-2">{{ $property->bedrooms }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-medium">Étage</td>
                        <td class="py-2">{{ $property->floor ?: 'Rez de chaussée'}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 pr-4 font-medium">Localisation</td>
                        <td class="py-2">
                            {{ $property->address }}<br>
                            {{ $property->city }} {{ $property->postal_code }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="lg:col-span-4">
                <h2 class="mb-4 text-2xl font-semibold text-gray-900">Spécificités</h2>
                <ul class="list-disc space-y-1 pl-5 text-gray-800">
                    @foreach ($property->options as $option)
                        <li>
                            {{ $option->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    </div>



@endsection
