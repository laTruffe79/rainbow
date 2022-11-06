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

<div
    class="relative flex items-top justify-center w-screen
    sm:items-center py-4 px-8 pt-12 sm:pt-0">

    <div class="flex w-full justify-center sm:justify-start items-center content-center sm:pt-0">
        @svg('icon-errors.404 error with portals-amico',"w-full")
    </div>

</div>


</body>
</html>

