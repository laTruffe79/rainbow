<?php

namespace App\Http\Livewire;

use App\Models\Purpose;
use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class EditQuestionComponent extends Component
{
    public int $questionId;
    public int $surveyId;
    public int $index;
    public bool $editable;

    public function mount($questionId,$index,$editable,$surveyId)
    {
        $this->questionId = $questionId;
        $this->index = $index;
        $this->editable = $editable;
        $this->surveyId = $surveyId;

    }

    public function render()
    {
        $question = Question::with(['purposes'])->findOrFail($this->questionId);
        $index = $this->index;
        $editable = $this->editable;

        /*$standardPurposesSatisfaction = Purpose::STANDARD_PURPOSES_SATISFACTION;*/
        /*$standardPurposeUtility = Purpose::STANDARD_PURPOSES_UTILITY;*/


        //get attached purposes to this survey
        $surveyId = $this->surveyId;
        $purposes = Purpose::with(['question'])
            ->whereHas('question.surveys',function (Builder $query) use ($surveyId){
                $query->where('survey_id',$surveyId);
            })
            ->get();

        //get constant purposes
        $constantPurposes = (new Purpose())->getConstants();

        //get constant array keys
        $constantPurposesArrayKeys = \array_keys($constantPurposes);

        //get attached purposes keys
        $purposesArrayKeys = [];
        foreach ($purposes as $purpose){
            $purposesArrayKeys[$purpose->question_id][] = $purpose->key;
        }

        $data = \compact('question','index','editable','purposes','constantPurposes',
            'constantPurposesArrayKeys','purposesArrayKeys');
        return view('livewire.edit-question-component',$data);
    }

    /**
     * @param array $purpose
     * @param int $questionId
     * @return void
     */
    public function attachPurposeToQuestion(array $purpose,int $questionId):void
    {
        $purpose['question_id'] = $questionId;
        Purpose::factory()->create($purpose);

    }

    public function detachPurposeToQuestion(int $purposeId)
    {
        return Purpose::find($purposeId)->delete();
    }
}
