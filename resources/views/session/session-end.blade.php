<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

</head>
<body class="antialiased blue-bg-app">
    <div class="relative flex items-top justify-center w-screen
        sm:items-center py-4 px-8  sm:pt-0">
        <h1 class="text-gray-200 text-2xl">Merci pour votre participation</h1>
    </div>

    <div class="flex items-top justify-center sm:justify-start sm:pt-0">
        @svg('icon-lgbt.Free love-amico',"h-42 w-42")
    </div>

    <div class="w-screen px-8 text-gray-200">
        {{--<h2 class="text-gray-200 text-xl my-8 text-center">
            Merci pour votre participation
        </h2>--}}
        <p class="mb-5 text-justify">
            Besoin d'aide pour toi ou un ami ? N'hésite pas à
            appeler Adhéos ou en parler à
            l'intervenant de cette formation.
        </p>

        <div class="w-full text-center text-gray-200 mt-6">
            <a href="https://www.adheos.org" class="px-8 w-full text-gray-200 text-xl tracking-wider py-4 rounded-lg bg-gradient-to-r
   from-violet-900 to-fuchsia-600 hover:bg-fuchsia-600
    transition-all transition ease-in-out duration-1000 font-bold" type="button">www.adheos.org</a>
        </div>

    </div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>

