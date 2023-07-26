<div x-data="{ dragging: false, showQuestions:false }"
     class=" bg-gradient-custom mb-10 shadow-xl shadow-blue-950 hover:shadow-blue-900 rounded-xl border border-blue-900">

    <div class="my-10 px-5 text-lg grid grid-cols-2">
        <div>
            <span class="mr-2">{{ $index+1 }} - {{ $question->question }}</span>
        </div>
        <div></div>
    </div>

        <div class="grid grid-cols-2 border-t border-blue-900 mt-3">
            <div id="dragDiv{{$index}}"
                 x-data="{adding:false}"
                 x-on:dragover.prevent="adding = true;"
                 x-on:drop.prevent="dropData = JSON.parse($event.dataTransfer.getData('application/json'));
                    target = document.querySelector('div#dragDiv{{$index}}');
                    id = dropData.id;element = document.getElementById(id);
                    document.querySelector('div#dropDiv{{$index}}').removeChild(element);
                    target.appendChild(element);
                    adding = false;
                    $wire.detachPurposeToQuestion(dropData.purposeId);"

                 class="dragDiv border-gray-200 rounded-xl p-6">
                <h2 class=" mb-10 leading-4 text-center">Réponses possibles</h2>

                @foreach($constantPurposes as $key => $availablePurpose)

                    @if(!in_array($availablePurpose->key,$purposesArrayKeys))

                        <button
                            x-data="{dragging:false, availablePurposeToJson: {!! str_replace('"', "'", $availablePurpose->toJson()) !!} }"
                            id="{{$key}}{{$index}}"
                            :class=" dragging ? 'bg-green-600 text-gray-200' : 'bg-fuchsia-600 hover:bg-fuchsia-500' "
                            x-on:dragstart.self="
                            dragging = true;
                            data = JSON.stringify({ id :$event.target.id, questionId: {{ $question->id }} , purpose: availablePurposeToJson })
                            $event.dataTransfer.effectAllowed = 'move';
                            $event.dataTransfer.setData('application/json', data);
                    		"
                            x-on:dragend.self="dragging = false"
                            class="mr-2 mb-2 px-6 py-2 text-center rounded-lg border border-gray-200
                            text-gray-200 "
                            draggable="true">
                            <div class="flex flex-col items-center">
                                @svg($availablePurpose['icon'],'h-8 w-8 fill-current')
                                {{ $availablePurpose['label'] }}
                            </div>

                        </button>
                    @endif

                @endforeach

            </div>
            <div
                x-data="{adding:false}"

                id="dropDiv{{$index}}"
                x-on:dragover.prevent="adding = true"
                x-on:drop.prevent="dropData = JSON.parse($event.dataTransfer.getData('application/json'));
                    target = document.querySelector('div#dropDiv{{$index}}');
                    id = dropData.id;
                    element = document.getElementById(id);
                    document.querySelector('div#dragDiv{{$index}}').removeChild(element);
                    target.appendChild(element);
                    adding = false;
                    $wire.attachPurposeToQuestion(dropData.purpose,dropData.questionId);"
                class="dropDiv border-blue-900 border-l p-6">
                <h2 class=" mb-10 leading-5 text-center">
                    Réponses attribuées
                </h2>

                @foreach($purposes as $key => $purpose)

                    @if($purpose->question_id == $question->id)
                        <button
                            x-data="{dragging:false}"
                            id="{{$purpose->key}}{{$key}}"
                            :class=" dragging ? 'bg-gray-200 text-fuchsia-500 ' : 'text-gray-200 bg-fuchsia-600 hover:bg-fuchsia-500' "
                            x-on:dragstart.self="
                            dragging = true;
                            data = JSON.stringify({ id :$event.target.id, questionId:'{{$question->id}}', purposeId : {{$purpose->id}} })
                            $event.dataTransfer.effectAllowed = 'move';
                            $event.dataTransfer.setData('application/json', data);"
                            x-on:dragend.self="dragging = false"
                            class="mr-2 mb-2 px-6 py-2 text-center rounded-lg border border-gray-200"
                            draggable="true">
                            <div class="flex flex-col items-center">
                                @svg($purpose['icon'],'h-8 w-8 fill-current')
                                {{ $purpose['label'] }}
                            </div>

                        </button>
                    @endif

                @endforeach

            </div>
        </div>




</div>
