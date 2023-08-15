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
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="text-center pt-8 mb-5">
            <h2 class="text-gray-200 font-bold text-2xl">Gestion des questionnaires</h2>
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('adminHome')}}" text="Retour" icon=""></x-custom-btn>
            </div>
            <div
                class="text-fuchsia-500 h-6 h-auto flex flex-col justify-items-end items-end hover:cursor-pointer">
                <x-custom-btn href="{{route('survey.create')}}" text="Créer questionnaire" icon=""></x-custom-btn>
            </div>
        </div>


        @if(isset($surveys))
            @foreach($surveys as $key => $survey)
        <div
            class="mt-3 py-5 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200 rounded-lg">

                    {{--Item--}}
                    <div class="flex h-auto px-6">

                        @livewire('edit-survey-component',[
    							'surveyId' => $survey->id
                        	]
                        )

                    </div>
                    @if(count($survey->questions) > 0)
                        <div x-data="{showQuestions:false}">

                            <div class="text-gray-200 px-6 my-5 text-lg">
                                <span class="hover:cursor-pointer"
                                      x-show="!showQuestions"
                                      x-on:click="showQuestions=!showQuestions">
                                    Assigner des réponses aux questions @svg('icon-fontawesome.svgs.solid.angle-down','ml-2 inline-block fill-current h6 w-6 text-fuchsia-500')
                                </span>
                                <span class="hover:cursor-pointer"
                                      x-cloak
                                      x-show="showQuestions"
                                      x-on:click="showQuestions=!showQuestions">
                                    Assigner des réponses aux questions @svg('icon-fontawesome.svgs.solid.angle-up','ml-2 inline-block fill-current h6 w-6 text-fuchsia-500')
                                </span>

                            </div>
                            <div x-cloak x-show="showQuestions" x-transition.duration.200ms class="text-gray-200 px-6">
                                <ul class="">
                                    @foreach($survey->questions as $index => $question)

                                        @livewire('edit-question-component',
                                                 ['questionId' => $question->id,
                                                 'surveyId' => $survey->id,
                                                 'index' => $index,
                                                 'editable' => count($question->answers) === 0 ]
                                        )

                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    @endif

                    {{--End item--}}

        </div>
        	@endforeach
        @endif
        @include('footer')

    </div>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@livewireScripts
</body>
</html>
