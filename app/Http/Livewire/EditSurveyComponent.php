<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditSurveyComponent extends Component
{

    public int $surveyId;
    public Survey $survey;
    public string $title;
    public string $description;

    protected $rules = [

		'title' => 'required|regex:/^[\pL\s\-1-9]+$/u|min:3|max:50',
		'description' => 'required|string|min:3|max:254',

    ];

    protected $messages  = [
        'title.regex' => 'Le titre ne doit contenir que des caractères alphanumériques',
        'title.min' => 'Le titre doit faire 3 caractères minimum',
        'title.max' => 'Le titre doit faire 50 caractères maximum',
    ];

    /**
     * @return void
     */
    public function mount(): void
    {
        /*get current survey*/
        $this->survey = Survey::findOrFail($this->surveyId);
        $this->title = $this->survey->title;
        $this->description = $this->survey->description;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $survey = $this->survey;
        $data = \compact('survey');
        return view('livewire.edit-survey-component',$data);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function updatedTitle(string $value): bool
    {
        $this->resetValidation();
        $this->validate();
        return $this->survey->update(['title' => $value]);

    }

    /**
     * @param string $value
     * @return bool
     */
    public function updatedDescription(string $value): bool
    {

        return $this->survey->update(['description' => $value]);

    }


}
