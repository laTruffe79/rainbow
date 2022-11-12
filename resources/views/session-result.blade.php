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

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="my-4">
            <x-custom-btn href="{{route('adminHome')}}" text="Retour liste des sessions"></x-custom-btn>
        </div>

        <div
            class="mt-8 px-6 py-4 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">

            <div class="text-center pt-4 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Rapport d'évaluation de la session </h2>
            </div>

            <h2 class="text-gray-200 text-left text-lg mb-5">
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
                <br>
                <span class="text-sm italic inline-flex items-center">
                @svg('icon-fontawesome.svgs.regular.user','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                    {{$countParticipants}} participants
                </span>

            </h2>
            <hr class="text-gray-200 mb-5">

            @if(isset($resultByQuestion) && $resultByQuestion !== null)
                @foreach($questions as $question)
                    <div class="my-4">
                        <h2 class="text-gray-200">{{$question->question}}</h2>
                        <div class="grid grid-rows-1 grid-flow-col gap-4 mt-4">

                                @if(round($resultByQuestion[$question->id]*100/$countParticipants,1) == 0)
                                <div class="bg-transparent rounded-lg text-left"
                                     style="width: auto">
                                    <span
                                        class="px-6 text-gray-200">0%</span>
                                </div>
                                    @else
                                    <div class="bg-gray-200 rounded-lg text-center"
                                         style="width: {{ $resultByQuestion[$question->id]*100/$countParticipants  }}%"><span
                                        class="px-6">{{round($resultByQuestion[$question->id]*100/$countParticipants,1)}} %</span>
                                    </div>
                            @endif


                        </div>
                    </div>
                @endforeach

                <hr class="text-gray-200"/>

                <div x-data="{showPositiveAnswers:false}">
                    <h2 title="Afficher/masquer les commentaire positifs"
                        x-on:click="showPositiveAnswers=!showPositiveAnswers"
                        class="text-gray-200 text-xl my-4 cursor-pointer underline inline-flex">Commentaires parmi les réactions positives</h2>
                    <ul x-show="showPositiveAnswers"
                        x-transition:enter.duration.300ms
                        x-transition:leave.duration.400ms
                        class="text-gray-200">
                        @foreach($positiveAnswers as $negativeAnswer)

                            <li class="mb-5">De {{$negativeAnswer->participant->pseudo}} :
                                <span class="italic">"{{$negativeAnswer->comment}}"</span>
                            </li>

                        @endforeach
                    </ul>
                </div>

                <hr class="text-gray-200"/>
                <div x-data="{showNegativeAnswers:false}">
                    <h2 title="Afficher/masquer les commentaires négatifs"
                        x-on:click="showNegativeAnswers= !showNegativeAnswers"
                        class="text-gray-200 text-xl my-4 cursor-pointer underline inline-flex">
                        Commentaires parmi les réactions négatives
                    </h2>
                    <ul x-show="showNegativeAnswers"
                        x-transition:enter.duration.300ms
                        x-transition:leave.duration.400ms
                        class="text-gray-200">
                        @foreach($negativeAnswers as $negativeAnswer)

                            <li class="mb-5">De {{$negativeAnswer->participant->pseudo}} :
                                <span class="italic">"{{$negativeAnswer->comment}}"</span>
                            </li>

                        @endforeach
                    </ul>
                </div>

            @else
                <h2 class="text-gray-200">Pas encore de résultats disponibles pour cette session</h2>
            @endif



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
