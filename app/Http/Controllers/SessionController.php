<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\School;
use App\Models\Session;
use App\Models\Survey;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use function redirect;
use function route;


class SessionController extends Controller
{
    /**
     * @param string $sessionSlug session slug
     * @return View
     */
    public function index(string $sessionSlug):View
    {


        try {
            $session = Session::where('slug', $sessionSlug)->with(['survey', 'school', 'animator'])->first();
            $illustrations = Survey::STANDARD_SURVEY_ILLUSTRATIONS;
            $data = \compact('session', 'illustrations');

            //@todo comment this for prod version
            //\Illuminate\Support\Facades\Session::flush();

        } catch (\Exception $e) {

            \dd($e->getMessage());

        }

        //destroy session data for test usage
        //\Illuminate\Support\Facades\Session::flush();

        return \view('session.session-home',$data);

    }

    /**
     * Show session results
     * @param string $sessionSlug session slug
     * @return View
     */
    public function showResult(string $sessionSlug):View
    {

        $session = Session::whereSlug($sessionSlug)
            ->with(['school','animator','answers','answers.question' ,'answers.purpose','survey','survey.questions'])
            ->first();
        //\dd($session);

        $answers = \App\Models\Answer::with(['purpose'])
            ->where('session_id',$session->id)
            ->get();
        //\dd($answers);

        $countParticipants = DB::table('answers')->distinct('participant_id')
            ->where('session_id',$session->id)
            ->count('participant_id');

        if(\count($answers)>0){

            $questions = $session->survey->questions;
            //\dd($questions);

            $resultByQuestion = array();

            foreach ($answers as $answer){
                if(!isset($resultByQuestion[$answer->question_id])){
                    $resultByQuestion[$answer->question_id] = $answer->purpose->satisfied;
                }else{
                    $resultByQuestion[$answer->question_id] += $answer->purpose->satisfied;
                }
            }



            //\dd($countParticipants);

            // get positive and negative comments
            $positiveAnswers = Answer::where('session_id',$session->id)
                ->whereNotNull('comment')
                ->whereHas('purpose', function($q){
                    return $q->where('satisfied',1);
                })
                ->with(['participant','purpose'])
                ->get();
            //\dd($positiveAnswers);

            $negativeAnswers = Answer::where('session_id',$session->id)
                ->whereNotNull('comment')
                ->whereHas('purpose', function($q){
                    return $q->where('satisfied',0);
                })
                ->with(['participant','purpose'])
                ->get();
            //\dd($negativeAnswers);

            return \view('session-result',
                \compact('session','questions','resultByQuestion','countParticipants','positiveAnswers','negativeAnswers'));


        }

        return \view('session-result',
            \compact('session','countParticipants'));


    }
    /**
     * Start a survey session and create participant
     * @param string $slug
     * @return RedirectResponse
     */
    public function startSurvey(string $slug):RedirectResponse
    {

        $session = Session::where('slug',$slug)->with(['survey','school','animator'])->first();
        $questions = $session->survey->questions;

        $questionsArray = $questions->toArray();

        // get questions collection first key
        $questionsFirstKey = $questions->keys()->first();

        // get last key of $questions collection
        $questionsLastKey = $questions->reverse()->keys()->first();

        //\dd(\Illuminate\Support\Facades\Session::get('token'));

        if(\Illuminate\Support\Facades\Session::get('token')==null){

            $participant = Participant::factory()
                ->create([
                    'session_id' => $session->id,
                    'question_id' => $questions[$questionsFirstKey]->id,
                    'last_question_id' => $questions[$questionsLastKey]->id,
                ]);

            \Illuminate\Support\Facades\Session::put('token',$participant->token);
            \Illuminate\Support\Facades\Session::put('currentQuestionId',$questions[$questionsFirstKey]->id);
            //return $this->showQuestion($slug,$firstQuestion);
            return redirect(route('session.show-question',
                ['slug'=>$slug, 'questionId'=>$questions[$questionsFirstKey]->id, $participant]));

        }else{

            try{

                $participantToken = \Illuminate\Support\Facades\Session::get('token');
                $participant = Participant::where('token',$participantToken)->firstOrFail();

                $currentQuestionId = $participant->question_id;

                return redirect(route('session.show-question',
                    ['slug'=>$slug,'questionId'=>$currentQuestionId,$participant]));

            }catch(ModelNotFoundException $modelNotFoundException){

                \dd($modelNotFoundException->getMessage());

            }

        }

    }


    /**
     * @param string $slug
     * @param int|null $questionKey cursor position in array
     * @param Participant|null $participant
     * @return View|Factory|Application|Redirector
     */
    public function showQuestion(string      $slug,
                                 int         $questionKey=null,
                                 Participant $participant=null): View|Factory|Application|RedirectResponse
    {

        if($participant == null && \Illuminate\Support\Facades\Session::get('token') !== null){

            try{
                $participantToken = \Illuminate\Support\Facades\Session::get('token');
                $participant = Participant::where('token',$participantToken)->firstOrFail();

            }catch(ModelNotFoundException $modelNotFoundException){

                \dd($modelNotFoundException->getMessage());

            }

        }

        // forbid access to non current question
        if ($questionKey !== $participant->question_id || $questionKey == null){

            return redirect(route('session.show-question',
                ['slug'=>$slug,'questionId'=>$participant->question_id,$participant]));

        }

        $session = Session::where('slug',$slug)->with(['survey','school','animator'])->first();
        $questions = $session->survey->questions;
        //\dd($questions->keys());

        $question = $questions->where('id', $questionKey)->first();
        //\dd($question);
        $currentQuestionKey = $questions->where('id', $questionKey)->keys()->first();
        //dd($questions[($currentQuestionKey+1)]->id);

        //get next question if current is not the last
        $questionKey == $questions->last()->id ? $nextQuestionIndex = null : $nextQuestionIndex = $questions[($currentQuestionKey+1)]->id;
        //dd($nextQuestionIndex);
        $illustrations = Survey::STANDARD_SURVEY_ILLUSTRATIONS;
        //\dd($questions[0]->purposes);
        $data = compact('session','illustrations','participant','question','nextQuestionIndex');

        return view('session.show-question',$data);

    }

    /**
     * Return next key in array based on an index $array = ['0'=>'a','1'=>'b','2'=>'c']; get_next_key_array($array,1) // return 2
     * @param $arr
     * @param $key
     * @return int|string|null
     */
    private function get_next_key_array( $arr, $key ) {
        $keys     = array_keys( $arr );
        $position = array_search( $key, $keys, true );
        $next_key = null;

        if ( isset( $keys[ $position + 1 ] ) ) {
            $next_key = $keys[ $position + 1 ];
        }

        return $next_key;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        /*get school list*/
        $schools = \App\Models\School::orderBy('name')->get();

        /*get animators list*/
        $animators = \App\Models\Animator::orderBy('name')->get();

        return \view('session-create',\compact('schools','animators'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validation
        $validated = $request->validate([
            'title' => 'required|regex:/^[a-zA-Zéèàçôïâ0-9\'\.,\- ]{1,50}$/i|max:50',
            'school_id' => 'integer|nullable',
            'animator_id' => 'integer|required',
            'name' => 'required_without:school_id|regex:/^[a-zA-Zéèàçôïâ0-9\'\.,\- ]{1,50}$/i|max:50',
            'phone' => 'required_without:school_id|digits:10|nullable',
            'email' => 'required_without:school_id|email|nullable',
        ]);

        //\dd($validated);

        //create school if not exists
        if(!isset($validated->school_id)){
            $school = School::factory()
                ->create([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'],
                ]);
        }else{
            $school = \App\Models\School::find($request->id);
        }

        //dd($school);

        $survey = Survey::all()->first();

        $session = Session::factory()->create([
            'school_id' => $school->id,
            'survey_id' => $survey->id,
            'animator_id' => $validated['animator_id'],
            'title' => $validated['title'],
        ]);

        //\dd($request);

        return redirect()->route('adminHome');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }


    /**
     * @param string $slug
     * @return View
     */
    public function endSurvey(string $slug):View
    {

        try {
            $session = Session::whereSlug($slug)->first();
            return \view('session.session-end',\compact('session'));
        }catch(\Exception $exception){
            \dd($exception->getMessage());
        }


    }
}
