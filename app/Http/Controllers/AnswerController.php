<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Participant;
use App\Models\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAnswerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreAnswerRequest $request): RedirectResponse
    {

        try {

           $validatedData = $request->validated();

            $answer = Answer::create(
                [
                    'participant_id' => $validatedData['participant_id'],
                    'question_id' => $validatedData['question_id'],
                    'available_purpose_id' => $validatedData['available_purpose_id'],
                    'session_id' => $validatedData['session_id'],
                    'comment' => $validatedData['comment'],
                ]
            );

            $participant = Participant::find($validatedData['participant_id']);
            $session = Session::find($validatedData['session_id']);

            $participant->question_id = $validatedData['nextQuestionIndex'] ?? $validatedData['question_id'];


            if(isset($validatedData['nextQuestionIndex'])){

                $participant->save();

                    return redirect(route('session.show-question',
                        ['slug'=>$session->slug,'questionId'=>$participant->question_id,$participant]));

            }

            // if the participant answered the last question we close his participation by setting the flag to 0
            $participant->token_is_valid = 0;
            $participant->save();

            //close participant session
            return redirect(route('end-survey',['slug' => $session->slug]));

        }catch (\Exception $exception){

            \dd($exception->getMessage());

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
