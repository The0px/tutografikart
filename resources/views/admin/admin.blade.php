<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.6.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.6.2/dist/js/tom-select.complete.min.js"></script>

    <title>@yield('title') | Administation</title>
</head>
<body class="bg-white">


    <nav class="bg-blue-800">
        <div class="container mx-auto flex flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="text-2xl font-bold text-white" href="/">Agence</a>
            @php
                $routes = request()->route()->getName() ?? '';
            @endphp
            <ul class="flex flex-wrap gap-2">
                <li>
                    <a href="{{ route('admin.property.index') }}" @class([
                        'rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-blue-700',
                        'bg-blue-900' => str_contains($routes, 'property.'),
                    ])>Gérer les biens</a>
                </li>
                <li>
                    <a href="{{ route('admin.option.index') }}" @class([
                        'rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-blue-700',
                        'bg-blue-900' => str_contains($routes, 'option.'),
                    ])>Gérer les options</a>
                </li>
            </ul>
            <div class="ms-auto">
                @auth
                <ul class="flex flex-wrap gap-2">
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-12 px-4">

        @include('admin.shared.flash')

        @yield('content')
    </div>

</body>

<script>

    new TomSelect('select[multiple]', {plugins: {'remove_button': {title: 'Supprimer'}}});

</script>

</html>
