<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}">

    @if($pdfView)
        <style>
            body {
                font-family: Arial, sans-serif;
            }

            h1 {
                font-size: 24px;
                color: #2A3165;
                text-align: center;
            }

            h2 {
                font-size: 14px;
                color: #2A3165;
            }

            h3 {
                font-size: 12px;
                color: #2A3165;
            }
        </style>
    @else
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" media="all">
    @endif

    @livewireStyles


</head>
<body class="antialiased">

<div
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        @if(!$pdfView)

            <div class="grid grid-cols-2">
                <div class="my-4">
                    <x-custom-btn href="{{route('adminHome')}}" text="Retour liste des sessions"></x-custom-btn>
                </div>
                <div x-data=""
                     class="h-auto flex flex-col justify-center text-right">
                    <div class="">
                        <a href=""
                            x-on:click.prevent="confirm('Êtes-vous sûr ?') ? window.location.href = '{{route('session.archive',['session' => $session->id])}}' : ''"
                            class="px-8 text-gray-200 py-4 rounded-lg bg-gradient-to-r
   from-violet-900 to-fuchsia-600 hover:bg-fuchsia-600 font-bold hover:from-fuchsia-600 hover:to-fuchsia-600 ">
                            Archiver
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div
            class="mt-8 px-6 py-4 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">

            @if($pdfView)
                <div style="">
                    <img src="{{$base64Logo}}" alt="" width="207" height="162">
                </div>
            @endif

            <div class="text-center pt-4 mb-5">
                <h1 class="text-gray-200 font-bold text-2xl">Synthèse d'évaluation de la session </h1>
            </div>

            <h2 class="text-gray-200 text-left text-lg mb-5">
                {{$session->title}} <br>
                <span class="inline-flex">
                  @svg('icon-fontawesome.svgs.solid.school','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                    {!! $pdfView ? 'Établissement : ' : '' !!} {{$session->school->name}}
                </span>
                <br>
                @if(isset($session->school->contact))
                    <span class="text-sm italic inline-flex items-center">
                        @svg('icon-fontawesome.svgs.regular.user','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                        Contact établissement : {{$session->school->contact}}
                    </span>
                    <br>
                @endif

                <span class="text-sm italic inline-flex">
                @svg('icon-fontawesome.svgs.solid.chalkboard-user','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                    {!! $pdfView ? 'Formateur : ' : '' !!}{{ucfirst($session->animator->name)}}
                </span>
                <br>
                <span class="text-sm italic inline-flex items-center">
                @svg('icon-fontawesome.svgs.regular.calendar-days','h-4 w-4 fill-current text-gray-200 mr-2 inline-block')
                    {!! $pdfView ? 'Date : ' : '' !!}{{ucfirst($session->created_at->format('d M Y'))}}
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
                                     style="width: {{ $resultByQuestion[$question->id]*100/$countParticipants  }}%; background-color:#BC26D1;
                                     {!! $pdfView ? 'text-align:center;color:#fff;border-radius: 30% 30% 30% 30%;': ''!!}"><span
                                        class="px-6">{{round($resultByQuestion[$question->id]*100/$countParticipants,1)}} %</span>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach

                @if(!$pdfView)

                    <hr class="text-gray-200"/>

                    @livewire('send-report',['animateur' => $session->animator->name ,
                                        'date' => $session->created_at->format('d M Y'),
                                        'attachmentContent' => $file,
                                         'schoolEmail' => $session->school->email ])

                    <hr class="text-gray-200 mt-6"/>

                    <div x-data="{showPositiveAnswers:false}">
                        <h2 title="Afficher/masquer les commentaire positifs"
                            x-on:click="showPositiveAnswers=!showPositiveAnswers"
                            class="text-gray-200 text-xl my-4 cursor-pointer underline inline-flex">Commentaires parmi
                            les réactions positives</h2>
                        <ul x-show="showPositiveAnswers"
                            x-transition:enter.duration.300ms
                            x-transition:leave.duration.400ms
                            class="text-gray-200">
                            @foreach($positiveAnswers as $positiveAnswer)

                                <li class="mb-5">"{{$positiveAnswer->question->question}}"<br>
                                    <span class="italic">De {{$positiveAnswer->participant->pseudo}} : "{{$positiveAnswer->comment}}"</span>
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

                                <li class="mb-5">"{{$negativeAnswer->question->question}}"<br>
                                    <span class="italic">De {{$negativeAnswer->participant->pseudo}} : "{{$negativeAnswer->comment}}"</span>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                @endif
            @else
                <h2 class="text-gray-200">Pas encore de résultats disponibles pour cette session</h2>
            @endif

        </div>

        @if(!$pdfView)

            @include('footer')

        @else
            <hr style="margin-top: 20px;margin-bottom: 20px">
            <div style="text-align: center">
                <h2>Adhéos association LGBTI & friendly <br>
                    5, passage Ancienne Caserne<br>
                    17100 Saintes <br>
                    Tél : 06 26 39 66 13 <br>
                    web : https://www.adheos.org
                </h2>
            </div>

        @endif

    </div>


</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts

<script type="text/javascript">
    window.onload = function () {
        Livewire.on('alert-remove', () => {

            setTimeout(function () {
                if (document.querySelector('.success')) {
                    setTimeout(function () {
                        document.querySelector('.success').remove();
                    }, 3000);
                }
            }, 200);


            if (document.querySelector('.error')) {
                setTimeout(function () {
                    document.querySelector('.error').remove();
                }, 30000);
            }
        })
    }
</script>
</body>
</html>
