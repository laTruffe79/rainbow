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

{{--Modal QR Code--}}
{{--<div x-cloak
     x-show="show"
     x-data="{show:false,qrCodeData:null}"

     @modal.window="qrCodeData=$event.detail.value;show=!show"
     style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10; margin: auto; width: 600px ; height: 600px; overflow: auto;"
     class="justify-center items-center bg-gray-200">

    <div @click.outside="show=false" class="z-50 mx-auto text-center bg-transparent w-full">
        <img x-bind:src="qrCodeData" src="" alt="" height="600px" width="600px"/>
    </div>

</div>--}}
@foreach($sessions as $key => $session)
    <div x-cloak
         x-ref="modal-{{$session->id}}"
         x-show="show && enabledSession"
         x-data="{show:false,enabledSession:false,qrCodeData:null}"
         x-init="enabledSession = {{$session->open}}"

         @enable-disable-{{$session->id}}.window="enabledSession=event.detail.toggle"
         @modal-{{$session->id}}.window="qrCodeData=$event.detail.value;show=!show && enabledSession"
         style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10; margin: auto; width: 600px ; height: 600px; overflow: auto;"
         class="justify-center items-center bg-gray-200">

        <div @click.outside="show=false" class="z-50 mx-auto text-center bg-transparent w-full">
            <img src="{{$session->qrcode}}" alt="" height="600px" width="600px"/>
        </div>

    </div>
@endforeach

{{-- End Modal QR Code --}}

<div
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('session.create')}}" text="Créer une session"></x-custom-btn>
            </div>
            <div class="h-auto flex flex-col justify-center">
                @include('menu-hamburger')
            </div>
        </div>


        <div
             class="mt-3 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">

            <div class="text-center pt-8 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Liste des interventions en milieu scolaire.</h2>
            </div>

            @foreach($sessions as $key => $session)
                {{--Item--}}
                <div class="flex h-auto p-5"
                     x-data="{ enabledLink: false }"
                     x-init="enabledLink = {{$session->open ===1 ? 'true' : 'false' }}"
                >
                    <div class="w-12 mr-2">
                        <a title="Afficher le QR Code"

                           @enable-disable-{{$session->id}}.window="enabledLink=event.detail.toggle"
                           class="transition ease-in-out duration-300"
                           x-on:click.prevent="$dispatch('modal-{{$session->id}}',{value:'{{$session->qrcode}}'})"
                           x-bind:class="enabledLink ? 'fill-fuchsia-500 hover:fill-fuchsia-400' : 'fill-gray-400 hover:cursor-default'"
                           href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <x-icon-icomoon.057-qrcode class="w-8 h-8"/>
                        </a>

                    </div>
                    <div class="flex-grow flex-1">
                        <a href="#" x-on:click.prevent="" class="cursor-default leading-7 font-bold underline text-gray-200">
                            {{$session->created_at->format('d-m-Y')}}
                            {{$session->school->name}} - {{ $session->title }}<br>
                            <span class="italic">{{$session->animator->name}}</span>
                        </a>
                    </div>

                    <div class="w-auto text-right">
                        @livewire('open-close-session',['session' => $session->id])
                    </div>
                    <div class="w-16 pl-6 text-fuchsia-600 flex justify-items-end">
                        <a title="Résultats" href="{{route('session.show-result',['slug'=>$session->slug])}}">
                            @svg('icon-fontawesome.svgs.solid.chart-simple','fill-current h6 w-6 hover:text-fuchsia-500')
                        </a>
                    </div>

                </div>
                {{--End item--}}
            @endforeach

            <div class="flex justify-center mt-4 mb-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    {{ $sessions->links() }}
                </div>
            </div>


        </div>


        @include('footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
