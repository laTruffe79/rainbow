<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unauthorized</title>
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles

</head>
    <body class="antialiased blue-bg-app h-screen">

        <div style="height: 100vh;" class="container grid grid-cols-1 gap-4 h-screen">
            <div class=""></div>
            <div class="w-full">
                @svg('icon-errors.403-forbidden-error',"w-full")
            </div>
            <div class=""></div>
        </div>

    </body>
</html>
