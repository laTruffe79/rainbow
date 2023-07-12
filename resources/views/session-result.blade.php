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
<body class="antialiased overflow-y-auto">

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

            <div class="text-center my-10">
                <h1 class="text-gray-200 font-bold text-3xl">Bilan de la session </h1>
            </div>

            <div class="grid grid-cols-3 gap-8 text-gray-200 mb-5 text-xl">

                <div class="gradient-custom-linear-blue gradient-custom-linear-blue shadow-xl shadow-blue-950
                     px-10 py-6 rounded-lg flex items-center place-content-center">
                    @svg('icon-fontawesome.svgs.solid.school','h-8 w-8 fill-current text-gray-200 mr-4 ')
                    <span class="inline align-text-bottom">
                        {!! $pdfView ? 'Établissement : ' : '' !!} {{$session->school->name}}
                        </span>
                </div>

                <div class="gradient-custom-linear-blue gradient-custom-linear-blue shadow-xl shadow-blue-950
                     px-10 py-6 rounded-lg flex items-center place-content-center">
                    @svg('icon-fontawesome.svgs.solid.user-group','h-8 w-8 fill-current text-gray-200 mr-4')
                    <span class="inline-flex items-center">
                            {{$session->title}}
                        </span>
                </div>

                <div
                    class="gradient-custom-linear-blue gradient-custom-linear-blue shadow-xl shadow-blue-950
                     px-10 py-6 rounded-lg flex items-center place-content-center">
                    @if(isset($session->school->contact))
                        @svg('icon-fontawesome.svgs.solid.user-check','h-8 w-8 fill-current text-gray-200 mr-4')
                        <span class="inline-flex items-center">
                                Contact : {{$session->school->contact}}
                            </span>
                    @endif
                </div>

                <div class="gradient-custom-linear-blue gradient-custom-linear-blue shadow-xl shadow-blue-950
                     px-10 py-6 rounded-lg flex items-center place-content-center">

                    @svg('icon-fontawesome.svgs.solid.chalkboard-user','h-8 w-8 fill-current text-gray-200 mr-4 ')
                    <span class="inline-flex items-center">
                            {!! $pdfView ? 'Formateur : ' : '' !!}{{ucfirst($session->animator->name)}}
                        </span>

                </div>

                <div
                    class="gradient-custom-linear-blue gradient-custom-linear-blue shadow-xl shadow-blue-950
                     px-10 py-6 rounded-lg flex items-center place-content-center">
                    @svg('icon-fontawesome.svgs.regular.calendar-days','h-8 w-8 fill-current text-gray-200 mr-4')
                    <span class=" inline-flex items-center">
                        {!! $pdfView ? 'Date : ' : '' !!}{{ucfirst($session->created_at->format('d M Y'))}}
                    </span>

                </div>

                <div
                    class="gradient-custom-linear-blue shadow-xl shadow-blue-950 px-10 py-6 rounded-lg flex items-center place-content-center">
                    @svg('icon-fontawesome.svgs.regular.user','h-8 w-8 fill-current text-gray-200 mr-4')
                    <span class="inline-flex items-center">
                        {{$countParticipants}} participants
                    </span>
                </div>

            </div>

            <hr class="text-gray-200 my-10">

            <div class="text-center mb-10">
                <h2 class="text-gray-200 font-bold text-2xl">Questions fermées</h2>
            </div>

            @if(isset($resultByQuestion) && $resultByQuestion !== null)
                @foreach($questions as $question)
                    <div
                        class="grid grid-cols-4 gap-3 rounded-lg my-6 text-xl gradient-custom-linear-blue flex items-center
                        place-content-center shadow-xl shadow-blue-950
                        hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900">
                        <div class="col-span-1 p-5">
                            <q class="text-gray-200">{{$question->question}}</q>
                        </div>
                        <div class="col-span-3 p-5">
                            <div class="my-4">

                                <div class="grid grid-rows-1 grid-flow-col gap-4 mt-4 blue-card-app rounded-lg">

                                    @if(round($resultByQuestion[$question->id]*100/$countParticipants,1) == 0)
                                        <div class="blue-card-app rounded-lg text-left"
                                             style="width: auto">
                                            <span class="px-6 text-gray-200">0%</span>
                                        </div>
                                    @else
                                        <div class="rounded-lg text-center"
                                             style="width: {{ $resultByQuestion[$question->id]*100/$countParticipants  }}%; background-color:#BC26D1;
                                     {!! $pdfView ? 'text-align:center;color:#fff;border-radius: 30% 30% 30% 30%;': ''!!}"><span
                                                class="px-6 text-gray-200">{{round($resultByQuestion[$question->id]*100/$countParticipants,1)}} %</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <hr class="text-gray-200 my-10">

                <div class="text-center mb-10">
                    <h2 class="text-gray-200 font-bold text-2xl">Questions ouvertes</h2>
                </div>

                @foreach($openQuestions as $k => $openQuestion)

                    <div class="rounded-lg my-6 text-xl p-5 shadow-xl shadow-blue-950
                        gradient-custom-linear-blue flex items-center place-content-center
                        hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900">
                        <q class="text-gray-200 text-xl">{{$openQuestion->question}}</q>
                    </div>

                    @foreach($openQuestion->purposesThroughAnswers->countBy('label') as $label => $countInGroup)
                        <div
                            class="grid grid-cols-5 auto-rows-min rounded-lg my-6 text-xl gradient-custom-linear-blue
                            flex items-center place-content-center
                            shadow-xl shadow-blue-950
                            hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900">
                            <div class="col-span-1 p-5">
                                <h2 class="text-gray-200">{{ $label }}
                                    : {{round($countInGroup*100/$openQuestion->answers_count,1)}} % </h2>
                            </div>
                            <div class="col-span-3 p-5">

                                <div class="my-4">
                                    <div class="blue-card-app rounded-lg grid grid-rows-1 grid-flow-col gap-4 mt-4">
                                        {{--{{ $label }} : {{ $countInGroup }}/{{$openQuestion->answers_count}}--}}
                                        @if(round($countInGroup*100/$openQuestion->answers_count,1) == 0)
                                            <div class="bg-transparent rounded-lg text-left"
                                                 style="width: 2%">
                                                <span class="px-6 text-gray-200">0%</span>
                                            </div>
                                        @else
                                            <div class="bg-gray-200 rounded-lg text-center"
                                                 style="width: {{ round($countInGroup*100/$openQuestion->answers_count,1)  }}%; background-color:#BC26D1;
                                     {!! $pdfView ? 'text-align:center;color:#fff;border-radius: 30% 30% 30% 30%;margin-bottom:15px;': ''!!}"><span
                                                    class="px-6 text-gray-200"></span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                @endforeach

                @if(!$pdfView)

                    <hr class="text-gray-200"/>

                    @livewire('send-report',['animateur' => $session->animator->name ,
                                        'date' => $session->created_at->format('d M Y'),
                                        'attachmentContent' => $file,
                                         'schoolEmail' => $session->school->email ])

                    <hr class="text-gray-200 mt-6"/>

                    <div class="rounded-lg blue-bg-app p-5 my-5 shadow-xl shadow-blue-950
                    hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900"
                         x-data="{showPositiveAnswers:false}">
                        <h2 title="Afficher/masquer les commentaire positifs"
                            x-on:click="showPositiveAnswers=!showPositiveAnswers"
                            class="text-gray-200 text-xl cursor-pointer underline inline-flex">Commentaires parmi
                            les réactions positives ({{count($positiveAnswers)}})</h2>

                        <div x-show="showPositiveAnswers"
                             x-transition:enter.duration.300ms
                             x-transition:leave.duration.400ms
                            class="grid grid-cols-3 bggra gap-8 text-gray-200 px-5 my-8">
                            @foreach($positiveAnswers as $index => $positiveAnswer)

                                <div class="text-justify pr-5">
                                    <q>
                                        {{$positiveAnswer->question->question}}
                                    </q>
                                </div>
                                <div class="col-span-2 text-left italic">
                                    De {{$positiveAnswer->participant->pseudo}} :
                                    "{{$positiveAnswer->comment}}"
                                </div>

                            @endforeach

                        </div>
                        {{--<ul
                            class="text-gray-200 mt-5">
                            @foreach($positiveAnswers as $positiveAnswer)

                                <li class="mb-5">"{{$positiveAnswer->question->question}}"<br>
                                    <span class="italic">De {{$positiveAnswer->participant->pseudo}} : "{{$positiveAnswer->comment}}"</span>
                                </li>

                            @endforeach
                        </ul>--}}
                    </div>

                    <hr class="text-gray-200"/>
                    <div class="rounded-lg blue-bg-app p-5 my-5 shadow-xl shadow-blue-950
                    hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900"
                         x-data="{showNegativeAnswers:false}">
                        <h2 title="Afficher/masquer les commentaires négatifs"
                            x-on:click="showNegativeAnswers= !showNegativeAnswers"
                            class="text-gray-200 text-xl cursor-pointer underline inline-flex">
                            Commentaires parmi les réactions négatives ({{count($negativeAnswers)}})
                        </h2>
                        <ul x-show="showNegativeAnswers"
                            x-transition:enter.duration.300ms
                            x-transition:leave.duration.400ms
                            class="text-gray-200 mt-5">
                            @foreach($negativeAnswers as $negativeAnswer)

                                <li class="mb-5">"{{$negativeAnswer->question->question}}"<br>
                                    <span class="italic">De {{$negativeAnswer->participant->pseudo}} : "{{$negativeAnswer->comment}}"</span>
                                </li>

                            @endforeach
                        </ul>
                    </div>

                    <hr class="text-gray-200 my-5"/>
                    <div class="rounded-lg blue-bg-app p-5 mb-5 shadow-xl shadow-blue-950
                    hover:shadow-xl hover:drop-shadow-2xl hover:shadow-blue-900"
                         x-data="{showOpenQuestionAnswers:false}">
                        <h2 title="Afficher/masquer les commentaires des questions de ressentis"
                            x-on:click="showOpenQuestionAnswers= !showOpenQuestionAnswers"
                            class="text-gray-200 text-xl cursor-pointer underline inline-flex">
                            Commentaires parmi les questions ouvertes ({{count($openQuestionsComments)}})
                        </h2>
                        <ul x-show="showOpenQuestionAnswers"
                            x-transition:enter.duration.300ms
                            x-transition:leave.duration.400ms
                            class="text-gray-200 mt-5">
                            @foreach($openQuestionsComments as $openQuestionsComment)

                                <li class="mb-5">"{{$openQuestionsComment->question->question}}"<br>
                                    <span class="italic">De {{$openQuestionsComment->participant->pseudo}} : "{{$openQuestionsComment->comment}}"</span>
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
