<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Session;
use App\Models\Survey;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function view;

class SurveyController extends Controller
{

    /**
     * return the index view with the list of the surveys
     * @return View
     */
    public function index(): View
    {
        $surveys = Survey::with(['sessions','sessions.answers','questions','questions.purposes'])->withTrashed()->get();

        $data = \compact('surveys');
        return view( 'survey.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Survey  $survey
     * @return Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
