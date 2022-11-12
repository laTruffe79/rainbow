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
    <h1 class="text-gray-200 text-2xl">Politique de confidentialité des données</h1>
</div>
<div class="relative flex items-top justify-center w-screen
        sm:items-center px-8 sm:pt-0">

    <div class="flex items-top justify-center sm:justify-start sm:pt-0">
        @svg('icon-GDPR-amico',"h-36 w-36")
        {{--@svg('icon-lgbt.Lesbian couple-amico',"h-36 w-36")--}}
    </div>
</div>
<div class="w-screen px-8 py-4 text-gray-200">

    <p class="text-lg text-justify">
        Les données collectées sont anonymisées et permettent à Adhéos de recueillir la satisfaction du public dans le
        souci d'améliorer les contenus.
        Aucun cookie n'est déposé sur le navigateur des personnes répondant aux questionnaires.
        Adhéos ne saurait être tenu pour responsable des propos condamnables pouvant être tenus dans les commentaires,
        mais veillera à les supprimer et surtout ne pas en faire la publicité.
    </p>

    <div class="w-full text-center text-gray-200 mt-6">
        <a href="{{route('session.index',['slug'=>$slug])}}" class="px-8 w-full text-gray-200 py-4 rounded-lg bg-gradient-to-r
   from-violet-900 to-fuchsia-600 hover:bg-fuchsia-600
    transition-all transition ease-in-out duration-1000 font-bold" type="submit">Retour</a>
    </div>


</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>

