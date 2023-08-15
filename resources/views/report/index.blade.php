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
    x-data="{
        'htmlCharts':'test',
        'getChartsData':function (){
            this.htmlCharts = document.getElementById('mainContainer').innerHTML
        }
    }"
    x-init=""
{{--    setTimeout( () => getChartsData(),500)--}}
    id="mainContainer"
    class="relative flex items-top justify-center min-h-screen blue-bg-app dark:blue-bg-app
    sm:items-center py-4 sm:pt-0">

    <div class="w-5/6 mx-auto sm:px-6 lg:px-8 relative">

        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            @svg('logo',"h-36 w-36")
        </div>

        <div class="grid grid-cols-2">
            <div class="my-4">
                <x-custom-btn href="{{route('adminHome')}}" text="Retour" icon=""></x-custom-btn>
            </div>

            <div class="h-auto flex flex-col justify-center text-right text-gray-200">
                <form action="{{route('report.create-pdf-report')}}"
                      enctype="multipart/form-data"
                      method="post">
                    @csrf
                    <input type="hidden" id="data1" name="data1" value="" />
                    <input type="hidden" id="data2" name="data2" value="" />
                    <input type="hidden" id="data3" name="data3" value="" />
                    <input type="hidden" id="data4" name="data4" value="" />
                    <input type="hidden" id="data5" name="data5" value="" />
                    <button
                        type="submit"
                        class="px-8 text-gray-200 py-4 rounded-full bg-gradient-to-r
   from-violet-900 to-fuchsia-600 hover:bg-fuchsia-600 font-bold hover:from-fuchsia-600 hover:to-fuchsia-600 ">
                        @svg('icon-fontawesome.svgs.solid.file-pdf','h-6 w-6 fill-gray-200 text-gray-200 inline-block')
                    </button>
                </form>
            </div>

        </div>


        <div class="mt-3 bg-white blue-card-app dark:blue-card-app overflow-hidden border
        border-gray-200 rounded-lg">

            <div class="text-center pt-8 mb-5">
                <h2 class="text-gray-200 font-bold text-2xl">Rapports</h2>
            </div>

            <div class="grid grid-cols-2 gap-4 px-6">
                <div class="text-center hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg text-center mb-4">Satisfaction globale</h2>
                    <canvas class="block mx-auto" id="pieGlobalSatisfaction"  style="height: 282px;width:282px;"></canvas>
                </div>
                <div class="text-center hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg">Satisfaction globale par années (5 dernières années)</h2>
                    <canvas id="chartGlobalSatisfactionPerYear" class="w-full"></canvas>
                </div>

                <div class="text-center hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg text-center">Satisfaction par département toutes années confondues</h2>
                    <canvas id="chartGlobalSatisfactionPerCountry" class="w-full"></canvas>
                </div>

                <div class="text-center hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg text-center">Satisfaction par intervenant toutes années confondues</h2>
                    <canvas id="chartGlobalSatisfactionPerAnimator" class="w-full"></canvas>
                </div>

                <div class="col-span-2 w-full text-center hover:bg-violet-900 mb-6 border-gray-200
                border rounded-xl rounded px-6 py-4 shadow shadow-md shadow-gray-400">
                    <h2 class="text-gray-200 text-lg text-center">Satisfaction par question toutes années confondues</h2>
                    <canvas x-on:load="getChartsData()" id="chartGlobalSatisfactionQuestion" class="w-full"></canvas>
                </div>


            </div>



            <div class="flex justify-center mt-4 mb-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    {{--{{ $sessions->links() }}--}}
                </div>
            </div>


        </div>


        @include('footer')

    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/charts.js') }}" ></script>

    <script>
        //*************************************************
        //Global satisfaction all years included (pie chart)
        const config1 = {
            type: 'pie',
            data: {
                labels : {!! json_encode($globalSatisfactionData['labels']) !!},
                datasets: [
                    {
                        label: '{!! json_encode($globalSatisfactionData['datasets'][0]['label']) !!}',
                        data: {!! json_encode($globalSatisfactionData['datasets'][0]['data']) !!},
                        backgroundColor: {!! json_encode($globalSatisfactionData['datasets'][0]['backgroundColor']) !!},

                    }
                ],
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        labels: {
                            color: "white",
                        },
                        position: 'top',
                    },
                    title: {
                        display: false,
                        text: 'Satisfaction globale'
                    }
                }
            },
        };
        const ctx1 = document.getElementById('pieGlobalSatisfaction');
        new Chart(ctx1,config1)


        //*****************************************
        // global satisfaction per year (bar chart)
        const ctx2 = document.getElementById('chartGlobalSatisfactionPerYear');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($arrayDataSatisfiedPerYear)) !!},
                datasets: [{
                    label: '% satisfaits',
                    backgroundColor: {!! json_encode(array_values($arrayDataSatisfiedPerYearBgColors)) !!},
                    data: {!! json_encode(array_values($arrayDataSatisfiedPerYear)) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //*****************************************
        // global satisfaction per country (bar chart)
        const ctx3 = document.getElementById('chartGlobalSatisfactionPerCountry');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($arrayDataSatisfiedPerCountry)) !!},
                datasets: [{
                    label: '% satisfaits',
                    backgroundColor: {!! json_encode(array_values($arrayDataSatisfiedPerCountryBgColors)) !!},
                    data: {!! json_encode(array_values($arrayDataSatisfiedPerCountry)) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        //*****************************************
        // global satisfaction per country (bar chart)
        const ctx4 = document.getElementById('chartGlobalSatisfactionPerAnimator');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($arrayDataSatisfiedPerAnimator)) !!},
                datasets: [{
                    label: '% satisfaits',
                    backgroundColor: {!! json_encode(array_values($arrayDataSatisfiedPerAnimatorBgColors)) !!},
                    data: {!! json_encode(array_values($arrayDataSatisfiedPerAnimator)) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //*****************************************
        // global satisfaction per question (bar chart)
        const ctx5 = document.getElementById('chartGlobalSatisfactionQuestion');
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($arrayDataSatisfiedPerQuestion)) !!},
                datasets: [{
                    label: '% satisfaits',
                    backgroundColor: {!! json_encode(array_values($arrayDataSatisfiedPerQuestionBgColors)) !!},
                    data: {!! json_encode(array_values($arrayDataSatisfiedPerQuestion)) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //set hidden field to base64 value of canvas graph
        setTimeout(function(){
            let canvas1 = document.getElementById('pieGlobalSatisfaction').toDataURL();
            let canvas2 = document.getElementById('chartGlobalSatisfactionPerYear').toDataURL();
            let canvas3 = document.getElementById('chartGlobalSatisfactionPerCountry').toDataURL();
            let canvas4 = document.getElementById('chartGlobalSatisfactionPerAnimator').toDataURL();
            let canvas5 = document.getElementById('chartGlobalSatisfactionQuestion').toDataURL();

            document.getElementById('data1').setAttribute('value',canvas1)
            document.getElementById('data2').setAttribute('value',canvas2)
            document.getElementById('data3').setAttribute('value',canvas3)
            document.getElementById('data4').setAttribute('value',canvas4)
            document.getElementById('data5').setAttribute('value',canvas5)
        },500)
    </script>

@livewireScripts
</body>
</html>
