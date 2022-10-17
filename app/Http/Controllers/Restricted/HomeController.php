<?php

namespace App\Http\Controllers\Restricted;

use App\Models\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use function compact;
use function view;

class HomeController extends \App\Http\Controllers\Controller
{

    public function __construct()
    {

    }


    /**
     * @return Application|Factory|View
     */
    public function index():Application|Factory|View
    {
        $sessions = Session::orderBy('id','desc')->with(['school'])->get();

        //\dd($sessions[0]->school->name);

        $data = compact('sessions');
        return view('welcome', $data);

    }

}
