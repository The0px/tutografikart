<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title') | MonAgence</title>
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
                    <a href="{{ route('property.index') }}" @class([
                        'rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-blue-700',
                        'bg-blue-900' => str_starts_with($routes, 'property'),
                    ])>Biens</a>
                </li>
            </ul>
        </div>
    </nav>

        @yield('content')

</body>


</html>
