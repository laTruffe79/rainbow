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
                <h2 class="text-gray-200 font-bold text-2xl">Gestion des questionnaires</h2>
            </div>

            @if(isset($surveys))
                @foreach($surveys as $key => $survey)
                    {{--Item--}}
                    <div class="flex h-auto px-6">

                        <div class="flex-grow flex-1">
                            <a href="#" x-on:click.prevent=""
                               class="cursor-default no-underline text-xl leading-7 font-bold text-gray-200">
                                Titre du questionnaire : {{ $survey->title }}<br>
                                Questionnaire crée le : {{$survey->created_at->format('d-m-Y')}}<br>
                                <span class="italic">Description : {{$survey->description}}</span>
                            </a>
                        </div>

                        <div class="w-16 pl-6 text-fuchsia-600 flex justify-items-end">
                            <a class="w-auto h-auto" title="Restaurer la session" href="">
                                @svg('icon-fontawesome.svgs.solid.circle-question','fill-current h6 w-6 hover:text-fuchsia-500')
                            </a>
                        </div>
                    </div>
                    @if(count($survey->questions) > 0)
                        <div x-data="{showQuestions:false}">
                            <div class="text-gray-200 px-6 my-5">
                                <span class="hover:cursor-pointer"
                                      x-on:click="showQuestions=!showQuestions">
                                    Questions @svg('icon-fontawesome.svgs.solid.angle-down','ml-2 inline-block fill-current h6 w-6 hover:text-fuchsia-500')
                                </span>

                            </div>
                            <div x-show="showQuestions" x-transition.duration.200ms class="text-gray-200 px-6">
                                <ul class="">
                                    @foreach($survey->questions as $index => $question)

                                        @php

                                            $editable = count($question->answers) === 0;

                                        @endphp

                                        @livewire('edit-question-component',
                                                 ['questionId' => $question->id,
                                                 'surveyId' => $survey->id,
                                                 'index' => $index,
                                                 'editable' => $editable ]
                                        )

                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    @endif

                    {{--End item--}}
                @endforeach
            @endif

        </div>

        @include('footer')

    </div>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
