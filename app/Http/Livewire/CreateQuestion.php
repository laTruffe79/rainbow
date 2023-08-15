<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateQuestion extends Component
{
    public ?string $question = null;
    public ?int $surveyId = null;
    public ?Survey $survey = null ;
    public ?string $questionType = null;

    protected $rules = [

        'question' => "required|regex:/^[\pL\s\-1-9\?\(\)\']+$/u|min:5|max:70",

    ];

    protected $messages  = [

        'question.regex' => 'La question ne doit contenir que des caractères alphanumériques',
        'question.min' => 'La question doit faire 5 caractères minimum',
        'question.max' => 'La question doit faire 70 caractères maximum',

    ];

    public function mount()
    {
        $this->questionType = 'STANDARD_PURPOSES_SATISFACTION';
    }

    /**
     * @return void
     */
    public function updatedSurveyId(): void
    {
        $this->survey = Survey::find($this->surveyId);
    }

    /**
     * @return bool
     */
    public function saveQuestion():bool
    {
        $this->resetValidation();
        $this->validate();

        try {
            if( !is_null($this->survey)){

                //create question
                $question = \App\Models\Question::create(
                    ['question' => $this->question , 'purpose_type' => $this->questionType, 'image' => \App\Models\Question::IMAGES_ARRAY[\rand(0,5)]]
                );
                // then attach question to survey
                $this->survey->questions()->attach($question->id);

                $this->emit('questionCreated',['result' => 'success', 'message' => 'Question crée !']);

                return true;

            }else{

                $this->emit('questionCreated',['result' => 'error', 'message' => 'Error']);

            }

        } catch (\Exception $e) {

            $this->emit('questionCreated',['result' => 'error', 'message' => 'Error : '.$e->getMessage()]);

        }
        return false;

    }

    public function render(): View
    {
        return view('livewire.create-question');
    }
}
