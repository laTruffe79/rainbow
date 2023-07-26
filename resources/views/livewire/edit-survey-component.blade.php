<div class="flex-grow flex-1 text-gray-200 text-lg "

     x-data="{
        showTitleField:false,
        showDescriptionField:false,
        handleFocusTitleField($refs) {
            if(this.showTitleField === true){
                $refs.title.focus()
                $refs.title.setSelectionRange($refs.title.value.length, $refs.title.value.length)
            }
        },
        handleFocusDescriptionField($refs) {
            if(this.showDescriptionField === true){
                $refs.description.focus()
                $refs.description.setSelectionRange($refs.description.value.length, $refs.description.value.length)
            }
        }
     }" >

    <p class="h-12 flex align-items-center">
        <span class="my-auto">
            Titre du questionnaire :
        </span>
        <span
            class="my-auto mx-2 cursor-pointer"
            x-on:click="showTitleField = true;$nextTick(() => { handleFocusTitleField($refs) })"
            x-show="!showTitleField">
             {{ $survey->title }}
        </span>
        <input
            x-show="showTitleField"
            x-ref="title"
            x-cloak
            x-on:keydown.enter="showTitleField =! showTitleField"
            type="text"
            name="tile"
            id="title"
            class="my-auto text-gray-800 w-1/2 mx-2 px-5 py-2 border border-blue-950 rounded-lg"

            value="{{$survey->title}}"
            wire:model.debounce.300ms="title">
        <a class="my-auto w-auto h-auto inline-block ml-2 text-fuchsia-500"
           x-on:click.prevent="showTitleField = !showTitleField; $nextTick(() => { handleFocusTitleField($refs) })"
           x-show="!showTitleField"
           href=""
           title="Éditer le titre">
            @svg('icon-fontawesome.svgs.solid.pencil','fill-current h-4 w-4')
        </a>
        <a class="my-auto w-auto h-auto inline-block ml-2 text-fuchsia-500 ml-3"
           x-cloak=""
           href=""
           x-show="showTitleField"
           x-on:click.prevent="showTitleField = !showTitleField"
           title="Cliquez pour valider le titre ou appuyez sur Entrée">
            @svg('icon-fontawesome.svgs.solid.check','fill-current h-6 w-6')
        </a>
        @error('title') <span class="error my-auto mx-2 text-red-500 font-bold text-base">{{ $message }}</span> @enderror

    </p>
    <p class="h-12 flex align-items-center">
        <span class="my-auto">Questionnaire crée le : {{$survey->created_at->format('d-m-Y')}}</span>
    </p>
    <p class="h-12 flex align-items-center">
        <span class="my-auto">Description :</span>
        <span
            x-show="!showDescriptionField"
            x-on:click="showDescriptionField = true; $nextTick(() => { handleFocusDescriptionField($refs) })"
            class="my-auto ml-2 cursor-pointer">
            {{$survey->description}}
        </span>
        <input
            x-show="showDescriptionField"
            x-cloak
            x-ref="description"
            x-on:keydown.enter="showDescriptionField =! showDescriptionField"
            type="text"
            name="description"
            id="description"
            class="my-auto text-gray-800 w-1/2 mx-2 px-5 py-2 border border-blue-950 rounded-lg"
            value="{{$survey->description}}"
            wire:model.debounce.300ms="description">
        <a class="my-auto w-auto h-auto inline-block ml-2 text-fuchsia-500"
           href=""
           x-on:click.prevent="showDescriptionField = !showDescriptionField; $nextTick(() => { handleFocusDescriptionField($refs) })"
           x-show="!showDescriptionField"
           title="Éditer la description">
            @svg('icon-fontawesome.svgs.solid.pencil','fill-current h-4 w-4')
        </a>
        <a class="my-auto w-auto h-auto inline-block ml-2 text-fuchsia-500 ml-3"
           x-show="showDescriptionField"
           x-cloak=""
           x-on:click.prevent="showDescriptionField = !showDescriptionField"
           title="Cliquez pour valider la description ou appuyez sur Entrée">
            @svg('icon-fontawesome.svgs.solid.check','fill-current h-6 w-6')
        </a>
    </p>
</div>
