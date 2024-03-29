<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'session_id' => 'required|integer',
            'purpose_id' => 'required|integer',
            'participant_id' => 'required|integer',
            'question_id' => 'required|integer',
            'comment' => 'nullable|string',
            'nextQuestionIndex' => 'nullable|integer'
        ];
    }
}
