<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\LegalNoticeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Restricted\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/home', [HomeController::class,'index'])->name('adminHome');
Route::get('admin/session/result/{slug}',[SessionController::class,'showResult'])->name('session.show-result');
Route::get('admin/session/create',[SessionController::class, 'create'])->name('session.create');
Route::post('admin/session/store',[SessionController::class,'store'])->name('session.store');
Route::get('admin/session/archive/{session}',[SessionController::class,'archive'])->name('session.archive');
Route::get('admin/session/list-archive/',[SessionController::class,'listArchives'])->name('session.list-archives');
Route::get('admin/session/restore/{session}',[SessionController::class, 'restoreSession'])->name('session.restore');

/* protected routes against not opened sessions */
Route::middleware(['session.is.open'])->group(function (){

    Route::get('/session/{slug}', [SessionController::class,'index'])
        ->name('session.index');

    Route::get('end-survey/{slug}',[SessionController::class,'endSurvey'])
        ->name('end-survey');

    // Protected routes against not valid participant token
    Route::middleware(['participant.token.is.valid'])->group(function(){
        Route::get('/start-survey/{slug}', [SessionController::class,'startSurvey'])
            ->name('start-survey');
        Route::get('/session/{slug}/show-question/{questionId?}', [SessionController::class,'showQuestion'])
            ->name('session.show-question');
        Route::post('/answer-question',[AnswerController::class,'store'])
            ->name('answer.store');
    });

});

Route::get('legal-notice/{slug}',[LegalNoticeController::class,'index'])->name('legal-notice.index');

/* Reports routes */
Route::get('/admin/report/index', [ReportController::class,'index'])->name('report.index');
Route::post('/admin/report/pdf', [ReportController::class,'createPdfReport'])->name('report.create-pdf-report');

/* Surveys management */
Route::get('admin/survey/index',[SurveyController::class,'index'])->name('survey.index');
Route::get('admin/survey/edit/{survey}',[SurveyController::class,'edit'])->name('survey.edit');



