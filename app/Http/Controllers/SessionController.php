<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Participant;
use App\Models\Question;
use App\Models\School;
use App\Models\Session;
use App\Models\Survey;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
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

            //destroy session data for test usage in debug environment
            if(\config('app.debug'))
                \Illuminate\Support\Facades\Session::flush();

        } catch (\Exception $e) {

            \dd($e->getMessage());

        }

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
            ->whereHas('question',function($q){
                $q->where('satisfiable',true);
            })
            ->get();
        //\dd($answers);

        $countParticipants = DB::table('answers')->distinct('participant_id')
            ->where('session_id',$session->id)
            ->count('participant_id');

        $file = '';
        $pdfView = false;
        $base64Logo = '';

        if(\count($answers)>0){

            $pdfView = true;

            $questions = $session->survey->questions->where('satisfiable',true);

            $resultByQuestion = array();

            foreach ($answers as $answer){
                if(!isset($resultByQuestion[$answer->question_id])){
                    $resultByQuestion[$answer->question_id] = $answer->purpose->satisfied;
                }else{
                    $resultByQuestion[$answer->question_id] += $answer->purpose->satisfied;
                }
            }

            $openQuestions = Question::withCount(['answers'])
                ->with(['answers','purposesThroughAnswers'])

                ->wherehas('answers',function($q)use ($session){
                    $q->where('session_id',$session->id);
                })
                ->where('satisfiable',false)
                ->get();

            //dd($openQuestions);

            // get positive and negative comments
            $positiveAnswers = Answer::where('session_id',$session->id)
                ->whereNotNull('comment')
                ->whereHas('purpose', function($q){
                    return $q->where('satisfied',1);
                })
                ->with(['participant','purpose','question'])
                ->get();

            $negativeAnswers = Answer::where('session_id',$session->id)
                ->whereNotNull('comment')
                ->whereHas('purpose', function($q){
                    return $q->where('satisfied',0);
                })
                ->with(['participant','purpose','question'=>function($q){ $q->orderBy('id'); }])
                ->get();

            $openQuestionsComments = Answer::where('session_id',$session->id)
                ->whereNotNull('comment')
                ->whereHas('question', function($q){
                    return $q->where('satisfiable',false);
                })
                ->with(['participant','purpose','question'=>function($q){ $q->orderBy('id'); }])
                ->get();


            //convert logo to base64 in order to generate pdf
            $path = \asset('img/logo-adheos.png');
            $type = \pathinfo($path,PATHINFO_EXTENSION);
            $aContext = array(
                'ssl' => array(
                    'verify_peer' => false,
                ),
            );
            $context = stream_context_create($aContext);
            $data = \file_get_contents($path,false,$context);
            $base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

            // Export data to pdf
            $pdf = Pdf::loadView('session-result',
                compact('session','questions','resultByQuestion','countParticipants',
                    'positiveAnswers','negativeAnswers','file','pdfView','base64Logo','openQuestions','openQuestionsComments'));


            $file = base64_encode($pdf->output([0]));

            $pdfView = false;

            return \view('session-result',
                \compact('session','questions','resultByQuestion','countParticipants',
                    'positiveAnswers','negativeAnswers','file','pdfView','base64Logo','openQuestions','openQuestionsComments'));

        }

        return \view('session-result',
            \compact('session','countParticipants','file','pdfView','base64Logo'));


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

        //\dd($request);

        // validation
        $validated = $request->validate([
            'title' => 'required|regex:/^[a-zA-Zéèàçôïâ0-9\'\.,\- ]{1,50}$/i|max:50',
            'school_id' => 'integer|nullable',
            'animator_id' => 'integer|required',
            'name' => 'required_without:school_id|regex:/^[a-zA-Zéèàçôïâ0-9\'\.,\- ]{1,50}$/i|max:50',
            'phone' => 'digits:10|nullable',
            'postal_code' => 'required_without:school_id|digits:5',
            'email' => 'required_without:school_id|email|nullable',
            'contact' => 'string|max:100|nullable',
        ]);

        //dd($validated);

        //create school if not exists
        if(!isset($validated['school_id'])){

            $school = School::factory()
                ->create([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'postal_code' => $validated['postal_code'],
                    'email' => $validated['email'],
                    'contact' => $validated['contact'],
                ]);
        }else{
            $school = \App\Models\School::find($validated['school_id']);
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
     * @param Session $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Session $session
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
     * @param Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Session $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }

    /**
     * @param Session $session
     * @return View
     */
    public function archive(Session $session):View
    {
        try {

            //@todo set open property to false before soft delete
            $session->open = false;
            $session->update();
            $session->delete();

            $sessions = Session::orderBy('id','desc')->with(['school','animator'])->paginate(10);
            $data = compact('sessions');
            return view('welcome', $data);
        }
        catch(Exception $exception){
            \dd($exception);
        }
    }

    /**
     * List archived sessions
     * @return View
     */
    public function listArchives():View
    {
        $sessions = Session::onlyTrashed()
            ->orderBy('id','desc')
            ->with(['school','animator'])
            ->get();

        //\dd($sessions);

        $data = compact('sessions');
        return view('session.list-archives', $data);

    }


    /**
     * Restore one session then refresh list archives
     * @param int $session
     * @return View
     */
    public function restoreSession(int $session)
    {

        try {

            $trashedSession = Session::onlyTrashed()->find($session);
            $trashedSession->restore();
            return $this->listArchives();

        }catch(Exception $exception){

            \dd($exception->getMessage());

        }

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
