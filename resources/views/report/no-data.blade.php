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
<body class="antialiased">

<div

    id="mainContainer"
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('adminHome')}}" text="Retour" icon=""></x-custom-btn>
            </div>

            <div class="h-auto flex flex-col justify-center text-right text-gray-200">

            </div>

        </div>


        <div class="mt-3 bg-white blue-card-app dark:blue-card-app overflow-hidden border
        border-gray-200 rounded-lg">

            <div class="text-center pt-8 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Rapports</h2>
            </div>

            <div class="grid grid-cols-2 gap-4 px-6">
                <div class="text-center col-span-2 hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg text-center mb-4">Pas de données disponibles</h2>

                </div>

            </div>

            <div class="flex justify-center mt-4 mb-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    {{--{{ $sessions->links() }}--}}
                </div>
            </div>

        </div>

        @include('footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>

@livewireScripts
</body>
</html>
