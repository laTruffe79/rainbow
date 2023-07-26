<?php

namespace App\Http\Livewire;

use App\Models\Purpose;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class EditQuestionComponent extends Component
{
    public int $questionId;
    public int $surveyId;
    public int $index;


    public function mount($questionId,$index,$surveyId)
    {
        $this->questionId = $questionId;
        $this->index = $index;
        $this->surveyId = $surveyId;

    }

    /**
     * @return View
     */
    public function render(): View
    {
        $question = Question::with(['purposes'])->findOrFail($this->questionId);
        $index = $this->index;

        /*$standardPurposesSatisfaction = Purpose::STANDARD_PURPOSES_SATISFACTION;*/
        /*$standardPurposeUtility = Purpose::STANDARD_PURPOSES_UTILITY;*/


        //get attached purposes to this survey
        $surveyId = $this->surveyId;
        $questionId = $this->questionId;
        /*$purposes = Purpose::with(['question'])
            ->whereHas('question.surveys',function (Builder $query) use ($surveyId,$questionId){
                $query->where('survey_id',$surveyId)->where('question_id',$questionId);
            })
            ->orderBy('order')
            ->get();*/
        $purposes = $question->purposes;

        //get available purposes
        $constantPurposes = \App\Models\AvailablePurpose::where('purpose_type',$question->purpose_type)->get();

        //get constant array keys
        $constantPurposesArrayKeys = !empty($constantPurposes->toArray()) ? \collect($constantPurposes->toArray())->pluck('key')->toArray() : [];

        //get attached purposes keys
        $purposesArrayKeys = !empty($purposes->toArray()) ? collect($purposes->toArray())->pluck('key')->toArray() : [];


        $data = \compact('question','index','purposes','constantPurposes',
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
            unset($purpose['purpose_type']);
            $purpose['available_purpose_id'] = $purpose['id'];
            unset($purpose['id']);
            $purpose['question_id'] = $questionId;

            Purpose::factory()->create($purpose);
            return true;

        } catch (\Exception $e) {
			\dump($e->getMessage());
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
            return true;
        }catch(\Exception $exception){

        }
        return false;
    }
}
