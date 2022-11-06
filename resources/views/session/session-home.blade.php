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
        <h1 class="text-gray-200 text-2xl">Bilan de la formation</h1>
    </div>
    <div class="relative flex items-top justify-center w-screen
        sm:items-center px-8 sm:pt-0">

        <h2 class="text-gray-200 text-left text-lg w-4/6">
            {{$session->title}} <br>
              <span class="inline-flex">
                  @svg('icon-fontawesome.svgs.solid.school','h-6 w-6 fill-current text-gray-200 mr-2 inline-block')
                  {{$session->school->name}}
              </span>
            <br>
            <span class="text-sm italic inline-flex">
                @svg('icon-fontawesome.svgs.solid.chalkboard-user','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                {{ucfirst($session->animator->name)}}
            </span>
            <br>
            <span class="text-sm italic inline-flex items-center">
                @svg('icon-fontawesome.svgs.regular.calendar-days','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                {{ucfirst($session->created_at->format('d M Y'))}}
            </span>
        </h2>


        <div class="flex items-top justify-center sm:justify-start sm:pt-0">
            @svg('icon-undraw.pride',"h-36 w-36")
            {{--@svg('icon-lgbt.Lesbian couple-amico',"h-36 w-36")--}}
        </div>
    </div>
    <div class="w-screen px-8 text-gray-200">
        <h2 class="text-gray-200 text-xl my-8 text-center">
            Merci pour votre participation
        </h2>

        <h2>Afin de nous aider à améliorer le contenu de cette formation, nous souhaiterions recueillir vos appréciations, cela ne prendra que 5 à 10 minutes.
            <br>Merci. </h2>
        <form action="">

            <div class="w-full text-center text-gray-200 mt-6">
                <a href="{{route('start-survey',['slug'=>$session->slug,'sessionId' => $session->id])}}" class="px-8 w-full text-gray-200 py-4 rounded-lg bg-gradient-to-r
       from-violet-900 to-fuchsia-600 hover:bg-fuchsia-600
        transition-all transition ease-in-out duration-1000 font-bold" type="submit">Commencer</a>
            </div>
        </form>

    </div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>

