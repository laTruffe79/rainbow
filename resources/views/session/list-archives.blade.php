<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{--@livewireStyles--}}

</head>
<body class="antialiased">



<div
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('adminHome')}}" text="Retour"></x-custom-btn>
            </div>
        </div>


        <div
             class="mt-3 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">

            <div class="text-center pt-8 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Sessions archivées.</h2>
            </div>

            @if(isset($sessions))
                @foreach($sessions as $key => $session)
                    {{--Item--}}
                    <div class="flex h-auto p-5">

                        <div class="flex-grow flex-1">
                            <a href="#" x-on:click.prevent="" class="cursor-default leading-7 font-bold underline text-gray-200">
                                {{$session->created_at->format('d-m-Y')}}
                                {{$session->school->name}} - {{ $session->title }}<br>
                                <span class="italic">{{$session->animator->name}}</span>
                            </a>
                        </div>

                        <div class="w-16 pl-6 text-fuchsia-600 flex justify-items-end">
                            <a class="w-auto h-auto" title="Restaurer la session" href="{{route('session.restore',['session' => $session->id])}}">
                                @svg('icon-fontawesome.svgs.regular.window-restore','fill-current h6 w-6 hover:text-fuchsia-500')
                            </a>
                        </div>

                    </div>
                    {{--End item--}}
                @endforeach
            @endif

            <div class="flex justify-center mt-4 mb-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    {{--{{ $sessions->links() }}--}}
                </div>
            </div>


        </div>


        @include('footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    {{--@livewireScripts--}}
</body>
</html>
