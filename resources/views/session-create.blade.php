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
    x-data="{sessionTitle:null,selectedSchoolId:'',animatorId:null,schoolName:null ,validSubmit:false,
    validate(){
        if( !this.animatorId || !this.sessionTitle){ return false }
        if( !this.selectedSchoolId && !this.schoolName){ return false }
        return true;
    }}"
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class=" block my-8 w-auto">
            <x-custom-btn href="{{route('adminHome')}}" text="Retour liste des sessions"></x-custom-btn>
        </div>

        <div
            class="mt-12 mb-12 px-6 py-4 bg-white blue-card-app dark:blue-card-app overflow-hidden border border-gray-200
            rounded-lg">

            <div class="text-center pt-4 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Créer une session </h2>
            </div>

            <form action="{{route('session.store')}}" method="POST">

                @csrf

                {{--Session title--}}
                <div class="flex justify-start">
                    <div class="mb-3 w-full">
                        <input
                            x-model="sessionTitle"
                            type="text"
                            style="padding-left: 8px;"
                            class="form-control
                                block w-full py-2 text-lg font-normal text-gray-700 bg-gray-200 bg-clip-padding
                                border border-solid border-gray-300
                                rounded-lg transition ease-in-out focus:text-gray-700 focus:bg-white"
                            id="title"
                            name="title"
                            pattern="^[a-zA-Zéèàçôïâ0-9'\.,\- ]{1,50}$"
                            required
                            placeholder="* Titre de la session"
                        />
                    </div>
                </div>

                <h2 class="text-gray-200 text-xl text-start my-4">Animateur</h2>
                {{--select animator--}}
                <div class="flex justify-start mt-4">
                    <div class="mb-3 w-full">
                        <select
                            x-model="animatorId"
                            name="animator_id"
                            style="padding-left: 6px;"
                            class="form-select appearance-none
                          block w-full px-5 py-2 font-normal text-gray-700
                          text-xl bg-white bg-clip-padding bg-no-repeat
                          border border-solid border-gray-300 rounded transition ease-in-out m-0
                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option value="" selected>Sélectionner un animateur</option>
                            @foreach($animators as $animator)
                                <option value="{{$animator->id}}">{{ucfirst($animator->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{--select school--}}
                <h2 class="text-gray-200 text-xl text-start my-4">Établissement</h2>
                <div class="flex justify-start mt-4">
                    <div class="mb-3 w-full">
                        <select
                            x-model="selectedSchoolId"
                            name="school_id"
                            style="padding-left: 6px;"
                            class="form-select appearance-none
                          block w-full px-5 py-2 font-normal text-gray-700
                          text-xl bg-white bg-clip-padding bg-no-repeat
                          border border-solid border-gray-300 rounded transition ease-in-out m-0
                          focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            aria-label="Default select example">
                            <option value="" selected>Pour un établissement existant</option>
                            @foreach($schools as $animator)
                                <option value="{{$animator->id}}">{{ucfirst($animator->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h2 class="text-gray-200 text-xl text-start my-4">Ou saisissez le si il ne figure pas dans la liste</h2>

                {{--school name--}}
                <div class="flex justify-start">
                    <div class="mb-3 w-full">
                        <input
                            x-bind:disabled="selectedSchoolId !== ''"
                            x-model="schoolName"
                            type="text"
                            style="padding-left: 8px;"
                            class="form-control
                                block w-full py-2 text-lg font-normal text-gray-700
                                bg-gray-200 bg-clip-padding border border-solid border-gray-300
                                rounded-lg transition ease-in-out focus:text-gray-700 focus:bg-white"
                            id="school_name"
                            name="name"
                            placeholder="* Nom de l'établissement"
                            pattern="^[a-zA-Zéèàçôïâ0-9'\.,\- ]{1,50}$"
                        />
                    </div>
                </div>

                {{--school phone--}}
                <div class="flex justify-start mt-8">
                    <div class="mb-3 w-full">
                        <input
                            x-bind:disabled="selectedSchoolId !== ''"
                            type="tel"
                            class="form-control w-full
                                block w-full py-2 text-lg font-normal text-gray-700
                                bg-gray-200 bg-clip-padding border border-solid border-gray-300
                                rounded-lg transition ease-in-out focus:text-gray-700 focus:bg-white"
                            id="phone"
                            name="phone"
                            style="padding-left: 6px;"
                            pattern="^[0-9]{10}$"
                            placeholder="Téléphone format 0549283200"
                        />
                    </div>
                </div>

                {{--school email--}}
                <div class="flex justify-start mt-8 mb-8">
                    <div class="mb-3 w-full">
                        <input
                            x-bind:disabled="selectedSchoolId !== ''"
                            type="email"
                            class="form-control w-full
                                block w-full py-2 text-lg font-normal text-gray-700
                                bg-gray-200 bg-clip-padding border border-solid border-gray-300
                                rounded-lg transition ease-in-out focus:text-gray-700 focus:bg-white"
                            id="email"
                            name="email"
                            style="padding-left: 6px;"
                            placeholder="E-mail de l'établissement"
                        />
                    </div>
                </div>

                <div class="w-full text-center text-gray-200 mt-6 mb-8">
                    <button
                        x-bind:disabled="!validate()"
                        x-bind:class="!validate() ? 'to-violet-900' : 'to-fuchsia-600'"
                        class="px-8 w-full text-gray-200 py-4 rounded-lg bg-gradient-to-r
   from-violet-900  hover:bg-fuchsia-600
    transition-all transition ease-in-out duration-1000 font-bold" type="submit">Valider</button>
                </div>

            </form>
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
