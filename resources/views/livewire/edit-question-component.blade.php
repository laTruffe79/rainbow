<div x-data="{ dragging: false }"
     class=" px-5 bg-gradient-custom mb-10 shadow-xl shadow-blue-950 hover:shadow-blue-900 rounded-xl border border-blue-900">

    <div class="my-10 text-lg grid grid-cols-2">
        <div>
            <span class="mr-2">{{ $index+1 }} - {{ $question->question }}</span>
        </div>
        <div>
            @if($editable)
                <span class="hover:text-fuchsia-500 text-fuchsia-600 hover:cursor-pointer">
            @svg('icon-zondicons.edit-pencil','mr-2 inline-block fill-current h4 w-4 ') Modifier la question</span>
            @endif
        </div>

    </div>

    @if($editable)

        <div
            class="grid grid-cols-2 gap-4 border-t border-blue-900 mt-3 pt-3">
            <div id="dragDiv{{$index}}"
                 x-on:dragover.prevent="adding = true"
                 x-on:drop.prevent="dropData = JSON.parse($event.dataTransfer.getData('application/json'));
                    target = document.querySelector('div#dragDiv{{$index}}');
                    id = dropData.id;element = document.getElementById(id);
                    document.querySelector('div#dropDiv{{$index}}').removeChild(element);
                    target.appendChild(element);
                    $wire.detachPurposeToQuestion(dropData.purposeId);"

                 class="dragDiv border-gray-200 rounded-xl p-6">
                <h2 class=" mb-10 leading-4 text-center">Réponses possibles</h2>

                @foreach($constantPurposes[$question->purpose_type] as $key => $availablePurpose)

                    @if(!in_array($key,$purposesArrayKeys[$question->id]))
                        @php
                            $availablePurpose['key'] = $key;
                        @endphp
                        <button
                            id="{{$key}}{{$index}}"
                            :class=" dragging ? 'bg-amber-600' : '' "
                            x-on:dragstart.self="
                            dragging = true;
                            data = JSON.stringify({ id :$event.target.id, questionId:'{{$question->id}}', purpose: {{json_encode($availablePurpose)}} })
                            $event.dataTransfer.effectAllowed = 'move';
                            $event.dataTransfer.setData('application/json', data);
                            "
                            x-on:dragend.self="dragging = false"
                            class="mr-2 mb-2 px-6 py-2 text-center rounded-lg border border-gray-200 text-gray-200 bg-fuchsia-600 hover:bg-fuchsia-500"
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
                id="dropDiv{{$index}}"
                x-on:dragover.prevent="adding = true"
                x-on:drop.prevent="dropData = JSON.parse($event.dataTransfer.getData('application/json'));
                    target = document.querySelector('div#dropDiv{{$index}}');
                    id = dropData.id;
                    element = document.getElementById(id);
                    document.querySelector('div#dragDiv{{$index}}').removeChild(element);
                    target.appendChild(element)
                    $wire.attachPurposeToQuestion(dropData.purpose,dropData.questionId)"
                class="dropDiv border-blue-900 border-l p-6">
                <h2 class=" mb-10 leading-5 text-center">
                    Réponses attribuées
                </h2>

                @foreach($purposes as $key => $purpose)

                    @if($purpose->question_id == $question->id)
                        <button
                            id="{{$purpose->key}}{{$key}}"
                            :class=" dragging ? 'bg-amber-600' : '' "
                            x-on:dragstart.self="
                            dragging = true;
                            data = JSON.stringify({ id :$event.target.id, questionId:'{{$question->id}}', purposeId : {{$purpose->id}} })
                            $event.dataTransfer.effectAllowed = 'move';
                            $event.dataTransfer.setData('application/json', data);"
                            x-on:dragend.self="dragging = false"
                            class="mr-2 mb-2 px-6 py-2 text-center  rounded-lg border border-gray-200 text-gray-200 bg-fuchsia-600 hover:bg-fuchsia-500"
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

    @else

        <span class="text-fuchsia-500"> @svg('icon-zondicons.exclamation-solid','mr-2 inline-block fill-current h4 w-4 ') Non modifiable, des réponses à cette question existent</span>

    @endif


</div>
