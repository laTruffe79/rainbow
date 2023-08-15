<div class="w-full items-start text-gray-200">

    <form class=""
          id="create-survey"
          x-data="{
              title:'',description:'',
              validTitle : false,
              validDescription : false,
              validate(field){
                const regex = new RegExp('^([A-Za-z \'?\!\u00C0-\u00D6\u00D8-\u00f6\u00f8-\u00ff\s]{5,70})$','gi')
                return (regex.test(field) )
              },
              validForm: false,
              validateForm(){
                this.validForm = (this.validTitle && this.validDescription);
              }
          }"
          x-init="$watch('title', value => {
            validTitle = validate(value)
            validateForm()
          });
          $watch('description', value => {
            validDescription = validate(value)
            validateForm()
          })"
          wire:submit.prevent="createSurvey">
        <div class="h-fit border border-gray-200 rounded-lg p-5 my-auto blue-card-app">
            <div class="flex gap-3 align-items-center h-auto">
                <div class="flex-none w-fit my-auto ">
                    <h2 class="text-gray-200 text-xl text-start my-3">Titre du questionnaire</h2>
                </div>
                <div class="grow my-auto">
                    <input x-model="title"
                           wire:model="title"
                           value=""
                        type="text" name="title" id="title" autocomplete="given-name"
                           class="block w-full rounded-md border-0 py-1.5 px-5 text-gray-900 shadow-sm ring-1
                                           ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                           focus:ring-indigo-600 sm:text-sm sm:leading-6"
                           required>

                </div>
                <div class="my-auto" x-show="validTitle" x-cloak="">@svg('icon-fontawesome.svgs.solid.check','h-6 w-6 text-fuchsia-500 fill fill-current ')</div>
                <div class="my-auto" x-show="!validTitle">@svg('icon-fontawesome.svgs.solid.circle-exclamation','h-6 w-6 text-fuchsia-500 fill fill-current ')</div>
            </div>
            <div class="flex gap-3 align-items-center h-auto">
                <div class="flex-none w-fit my-auto ">
                    <h2 class="text-gray-200 text-xl text-start my-3">Description</h2>
                </div>
                <div class="grow my-auto">
                    <input type="text" name="description" id="description" autocomplete="given-name"
                           x-model="description"
                           wire:model="description"
                           required
                           class="block w-full rounded-md px-5 border-0 py-1.5 text-gray-900 shadow-sm ring-1
                                           ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                           focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    {{--^[\pL\s\-1-9\?\(\)\']+$--}}
                </div>
                <div class="my-auto" x-show="validDescription" x-cloak="">@svg('icon-fontawesome.svgs.solid.check','h-6 w-6 text-fuchsia-500 fill fill-current ')</div>
                <div class="my-auto" x-show="!validDescription">@svg('icon-fontawesome.svgs.solid.circle-exclamation','h-6 w-6 text-fuchsia-500 fill fill-current ')</div>
            </div>
            <div class="text-center">
                <input type="submit"
                       x-bind:value="validForm ? 'Créer' : 'Le titre et la description doivent être conformes'"
                       x-bind:class="validForm ? 'to-fuchsia-600 hover:cursor-pointer' : ' to-violet-900 hover:cursor-no-drop' "
                       class="px-16 text-gray-200 py-4 rounded-lg bg-gradient-to-r from-violet-900  font-bold" />
            </div>
        </div>
    </form>
</div>
