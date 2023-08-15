<?php

namespace App\Http\Livewire;

use Livewire\Component;


class CreateSurvey extends Component
{

    public string $title;
    public string $description;

    protected $rules = [

        'title' => "required|regex:/^[\pL\s\-1-9\?\(\)\']+$/u|min:5|max:70",
        'description' => "required|regex:/^[\pL\s\-1-9\?\(\)\']+$/u|min:5|max:70",

    ];

    protected $messages  = [
        'title.regex' => 'Le titre ne doit contenir que des caractères alphanumériques',
        'title.min' => 'Le titre doit faire 5 caractères minimum',
        'title.max' => 'Le titre doit faire 70 caractères maximum',
        'description.regex' => 'La description ne doit contenir que des caractères alphanumériques',
        'description.min' => 'La description doit faire 5 caractères minimum',
        'description.max' => 'La description doit faire 70 caractères maximum',
    ];


    public function mount(): void
    {
        $this->title = '';
        $this->description ='';

    }

    /**
     * @return bool
     */
    public function createSurvey():bool
    {
        $this->resetValidation();
        $this->validate();

        try {
            $survey = \App\Models\Survey::create(['title' => $this->title, 'description' => $this->description]);
            $this->emit('surveyCreated',['surveyId' => $survey->id]);
            return true;

        } catch (\Exception $e) {
            \dd('Error : '.$e->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.create-survey');
    }
}
