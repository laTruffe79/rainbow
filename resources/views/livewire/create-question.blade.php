<div class="items-start text-gray-200"
     x-data="{submitDisabled:true,
     survey_id:@entangle('surveyId'),
     question:'',
     listen(){
        window.livewire.on('surveyCreated', (survey) => {
            this.survey_id = survey.surveyId
        })

        window.livewire.on('questionCreated', (result) => {
            console.log(result)
            if (result){
                console.log('question created !')
            }
        })
     },
     validate(field){
            const regex = new RegExp('^([A-Za-z \'?\!\u00C0-\u00D6\u00D8-\u00f6\u00f8-\u00ff\s]{5,70})$','gi')
            return (regex.test(field) )
          },
         validForm: false,
     }"
     x-init="
     listen()
     $watch('question', value => {
            submitDisabled = !validate(value)
     })
     ">
    <form name="addQuestion" id="" class="" wire:submit.prevent="saveQuestion">
        <div class="grow h-fit border border-gray-200 rounded-lg p-5 my-auto blue-card-app">
            <div class="flex gap-3 align-items-center h-auto">
                <div class="flex-none w-fit my-auto ">
                    <h2 class="text-gray-200 text-xl text-start my-3">Ajouter une question</h2>
                </div>
                <div class="grow my-auto">
                    <input type="text" name="question" id="question" autocomplete="off"
                           x-model="question"
                           wire:model="question"
                           class="block w-full rounded-md border-0 py-1.5 px-5 text-gray-900 shadow-sm ring-1
                                           ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                                           focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>

            </div>
            <div class="flex gap-3 align-items-center h-auto mb-3">
                <div class="flex-none w-fit my-auto ">
                    <h2 class="text-gray-200 text-xl text-start my-3">Choisir un type</h2>
                </div>
                <div class="grow my-auto">
                    <select name="purpose_type" id=""
                            class="p5 text-gray-900 px-3 py-2 rounded-lg"
                            wire:model="questionType">
                        <option selected value="STANDARD_PURPOSES_SATISFACTION">Question de satisfaction standard
                        </option>
                        <option value="STANDARD_PURPOSES_CHANGED_MIND">Question de changement d'avis</option>
                        <option value="OPEN_LAST_QUESTION_PURPOSES">Question de ressenti</option>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <input type="hidden" wire:model="surveyId" name="surveyId">
                <input type="submit"
                       x-bind:disabled="submitDisabled"
                       x-bind:value=" submitDisabled ? 'La question doit être conformes':'Créer'"
                       x-bind:class="submitDisabled ?  ' to-violet-900 hover:cursor-no-drop' : 'to-fuchsia-600 hover:cursor-pointer' "
                       class="px-16 text-gray-200 py-4 rounded-lg bg-gradient-to-r from-violet-900  font-bold"
                >
                </input>
            </div>
        </div>
    </form>

</div>


