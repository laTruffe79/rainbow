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
        $questionId = $this->questionId;
        $purposes = Purpose::with(['question'])
            ->whereHas('question.surveys',function (Builder $query) use ($surveyId,$questionId){
                $query->where('survey_id',$surveyId)->where('question_id',$questionId);
            })
            ->orderBy('order')
            ->get();

        //get constant purposes
        $constantPurposes = (new Purpose())->getConstants();

        //\dd($constantPurposes);

        //get constant array keys
        $constantPurposesArrayKeys = \array_keys($constantPurposes);



        //get attached purposes keys
        $purposesArrayKeys[$this->questionId] = [];
        foreach ($purposes as $purpose){
            $purposesArrayKeys[$this->questionId][] = $purpose->key;
        }

        $data = \compact('question','index','editable','purposes','constantPurposes',
            'constantPurposesArrayKeys','purposesArrayKeys');
        return view('livewire.edit-question-component',$data);
    }

    /**
     * @param array $purpose
     * @param int $questionId
     * @return bool
     */
    public function attachPurposeToQuestion(array $purpose,int $questionId): bool
    {

        try {
            $purpose['question_id'] = $questionId;
            Purpose::factory()->create($purpose);
            return true;
        } catch (\Exception $e) {

        }
        return false;
    }

    /**
     * @param int $purposeId
     * @return bool
     */
    public function detachPurposeToQuestion(int $purposeId): bool
    {
        try {
            Purpose::find($purposeId)->delete();
            /*$this->render();*/
            return true;
        }catch(\Exception $exception){

        }
        return false;
    }
}
