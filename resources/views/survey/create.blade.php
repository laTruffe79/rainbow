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
<body class="antialiased min-h-screen blue-bg-app">

<div
    x-data="{questionFormHide:true, questionAddLinkHide:true, flashVisible:false, flashResult:null, flashMessage:null}"
    x-init="() => {
        window.livewire.on('surveyCreated', () => {
            questionFormHide = false
            questionAddLinkHide = false
        })
    }"
    class="relative flex items-top justify-center blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    {{--flash notification--}}
    <div x-cloak class="absolute top-5 right-0 z-10 mr-2">
        <div
            x-init="
            window.livewire.on('questionCreated', (result) => {
                flashMessage = result.message;
                flashResult = result.result;
                flashVisible = true;
                setTimeout(() => {
                    flashVisible = false
                }, 2000)
            })
            "
            x-show="flashVisible"
            x-transition.opacity.duration.300ms
            x-bind:class="flashResult === 'success' ? 'bg-green-600' : 'bg-red-600'"
            x-text="flashMessage"
            class="alert alert-success py-5 px-8 text-white rounded-lg">
        </div>
    </div>

    <div class="w-5/6 mx-auto relative ">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="text-center pt-8 mb-5">
            <h2 class="text-gray-200 font-bold text-2xl">Créer un questionnaire</h2>
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('adminHome')}}" text="Retour" icon=""></x-custom-btn>
            </div>

        </div>

        <div class="flex grid-cols-2 gap-5 text-gray-200 mt-3">
            <div class="w-fit flex-none">
                <div class=" border-gray-200 border rounded-lg px-5 py-8 blue-card-app">

                    <ul class="text-xl">
                        <li x-show="questionAddLinkHide" >Titre et
                            description
                            @svg('icon-fontawesome.svgs.solid.check','h-5 w-5 text-fuchsia-500 fill fill-current inline-block')</li>
                        <li x-show="!questionAddLinkHide"
                            x-cloak=""
                            x-on:click="questionFormHide = false">
                            Questions
                            @svg('icon-fontawesome.svgs.solid.circle-plus','h-6 w-6 text-fuchsia-500 fill fill-current inline-block')
                        </li>
                    </ul>

                </div>
            </div>

            <div class="grow w-full">

                <div x-show="questionFormHide"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90">
                    {{-- form create survey --}}
                    @livewire('create-survey')
                    {{-- end form --}}
                </div>
                <div x-show="!questionFormHide"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-90"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-90" x-cloak>
                    {{-- form create question --}}
                    @livewire('create-question')
                    {{-- end form --}}
                </div>

            </div>

        </div>
        <div class="w-full">
            @include('footer')
        </div>

    </div>

</div>


<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
