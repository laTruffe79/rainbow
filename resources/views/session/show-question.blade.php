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
<body x-data="{selectedPurposeId:null}" class="antialiased blue-bg-app px-8">

<div class="flex items-top py-5 justify-center sm:justify-start sm:pt-0">
    @svg($illustrations[rand(0,5)],"w-1/2 h-1/2")
</div>

<div class="w-full items-top justify-left
        sm:items-center text-gray-200 sm:pt-0 mb-5 pl-2">
    <h1 class="text-2xl">Bilan de la formation</h1>
    <p class="text-xs">{{$session->school->name}} - {{$session->title}}
    </p>
</div>
<div class="relative flex items-top justify-center w-screen
        sm:items-center px-8 sm:pt-0">
</div>

<div class="w-full text-gray-200 p-3 border-gray-200 border rounded-lg mb-8 blue-card-app">
    <h1 class="text-gray-200 text-lg qu">
        {{ $question->question }}
    </h1>

    <form method="POST"
          action="{{route('answer.store',['session_id' => $session->id,'participant_id' =>$participant->id,'question_id' => $question->id, 'nextQuestionIndex' => $nextQuestionIndex])}}"
          name="answer">
        @csrf
        <div class="grid grid-cols-2 gap-4 mt-2">
            @foreach($question->purposes as $key => $purpose)
                <button
                    x-bind:class="selectedPurposeId=='{{ $purpose->id }}' ? 'bg-fuchsia-800 border-fuchsia-500 shadow-fuchsia-500' : 'bg-gradient-custom border-blue-900 shadow-blue-900'"
                    x-on:click.prevent="selectedPurposeId='{{ $purpose->id }}'"
                    class="grow text-center p-3 text-gray-200 flex flex-col justify-center items-center
                     shadow-lg rounded-xl border ">
                    @svg($purpose->icon,"w-8 h-8 fill-current text-gray-200 mb-2")
                    <span>{{$purpose->label}}</span>
                </button>
            @endforeach
            <input type="hidden" name="purpose_id" id="purpose_id" x-model="selectedPurposeId">
        </div>

        <textarea class="mt-6 border border-gray-200 resize-none w-full h-full blue-card-app pl-5 pt-5 pr-5 pb-5"
                  style="padding: 5px;"
                  rows="6"
                  name="comment"
                  placeholder="Pourquoi ce choix ? (facultatif)"></textarea>
        <div class="w-full text-center text-gray-200 my-4">
            <button
                x-bind:disabled="selectedPurposeId==null"
                x-bind:class="selectedPurposeId==null ? 'to-violet-400' : 'to-fuchsia-600'"
                class="px-8 w-full text-gray-200 py-4 rounded-lg bg-gradient-to-r
   from-violet-900 hover:bg-fuchsia-600
    transition-all transition ease-in-out duration-1000 font-bold" type="submit">Valider
            </button>
        </div>
    </form>

</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
<script>
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function () {
        window.history.go(1);
    };
</script>
</body>
</html>

