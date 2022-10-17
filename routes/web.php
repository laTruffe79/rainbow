<?php

use App\Http\Controllers\Restricted\HomeController;
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

Route::get('/admin/home', [HomeController::class,'index']);

Route::get('/survey/{slug}', [SurveyController::class,'index'])->name('survey-slug');

