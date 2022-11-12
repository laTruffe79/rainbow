<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LegalNoticeController extends Controller
{

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function index(string $slug): Application|Factory|View
    {

        return view('legal-notice',\compact('slug'));

    }

}
