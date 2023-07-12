<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render():View
    {

        $menuItems = array(
            'survey.index' => 'Questionnaires',
            'report.index' => 'Rapports',
            'session.list-archives' => 'Archives',
        );

        return view('components.menu',\compact('menuItems'));
    }
}
