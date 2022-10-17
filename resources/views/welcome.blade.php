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
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="my-4">
            <x-custom-btn href="#" text="Créer une session"></x-custom-btn>
        </div>

        <div class="mt-8 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">


            <div class="text-center pt-8 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Liste des sessions</h2>
            </div>

            {{--<div class="grid grid-cols-1 md:grid-cols-2 mt-4">
            </div>--}}

                @foreach($sessions as $key => $session)
                    {{--Item--}}
                    <div class="flex w-full h-auto p-5">
                    <div class="w-12">
                        <x-icon-icomoon.057-qrcode class="w-8 h-8 fill-cyan-400" />
                    </div>
                    <div class="w-auto">
                        <a href="#" class=" leading-7 font-bold underline text-gray-200">
                            {{$session->created_at->format('d-m-Y')}}
                            {{$session->school->name}}
                        </a>
                    </div>
                    <div class=" flex-1 text-right">
                            <span class="text-sm  text-gray-200 dark:text-gray-200 font-bold leading-7">
                                Ouverte
                            </span>
                    </div>
                    <div class="w-auto">

                        @livewire('open-close-session',['session' => $session])

                    </div>
                </div>
                    {{--End item--}}
                @endforeach

        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

            <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
