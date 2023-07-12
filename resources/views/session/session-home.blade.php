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
<body class="antialiased blue-bg-app px-8">

    <div class="flex items-top py-8 justify-left sm:justify-start sm:pt-0">
        @svg('icon-undraw.pride',"w-full h-full")
        {{--@svg('icon-lgbt.Lesbian couple-amico',"h-36 w-36")--}}
    </div>

    <div class="w-full items-top justify-left
        sm:items-center text-gray-200 sm:pt-0 mb-5 pl-2">
        <h1 class="text-2xl">Bilan de la formation</h1>
        <p class="text-xs">{{$session->school->name}} - {{$session->title}}
        </p>
    </div>

    <div class="grid grid-cols-2 gap-3 mb-5 w-full items-top justify-center
        sm:items-center sm:pt-0 text-gray-200 text-left">

        <div class="bg-gradient-custom p-3 shadow-xl shadow-blue-900 text-center rounded-xl border border-blue-900">
            <span class="text-sm italic inline-flex">
                @svg('icon-fontawesome.svgs.solid.chalkboard-user','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                {{ucfirst($session->animator->name)}}
            </span>
        </div>
        <div class="bg-gradient-custom p-3 shadow-xl shadow-blue-900 text-center rounded-xl border border-blue-900">
            <span class="text-sm italic inline-flex items-center">
                @svg('icon-fontawesome.svgs.regular.calendar-days','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                {{ucfirst($session->created_at->format('d M Y'))}}
            </span>
        </div>
        <div>

        </div>

    </div>
    <div class="w-full break-words px-8 text-gray-200 bg-gradient-custom p-5 shadow-xl shadow-blue-900 rounded-xl border border-blue-900" x-data="{acceptPolicy:false}">
        <h2 class="text-gray-200 text-xl mb-5 text-center">
            Merci pour votre participation
        </h2>

        <p>
            Afin de nous aider à améliorer le contenu de cette formation, nous souhaiterions recueillir vos
            appréciations, cela ne prendra que 5 à 10 minutes.
        </p>
        <p>Merci.</p>
        <form action="">

            <div class="flex items-center mb-4 mt-2">
                <input x-model="acceptPolicy" id="default-checkbox" type="checkbox" value="" class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox" class="text-sm font-medium text-gray-900 dark:text-gray-300">
                    <a class="underline text-sm text-justify" href="{{route('legal-notice.index',['slug'=>$session->slug])}}">J'accepte la politique de confidentialité des données conforme au RGPD.</a>
                </label>
            </div>

            <div class="w-full text-center text-gray-200 mt-6">
                <div
                    x-bind:class="!acceptPolicy ? 'to-violet-900' : 'to-fuchsia-600'"
                   class=" w-full text-gray-200 py-4 rounded-lg bg-gradient-to-r
       from-violet-900  hover:bg-fuchsia-600
        transition-all transition ease-in-out duration-1000 font-bold text-center">
                    <a x-bind:href="!acceptPolicy ? 'javascript:void(0)' : '{{route('start-survey',['slug'=>$session->slug,'sessionId' => $session->id])}}'"
                       href="{{route('start-survey',['slug'=>$session->slug,'sessionId' => $session->id])}}">
                        Commencer
                    </a>
                </div>
            </div>

        </form>

    </div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>

