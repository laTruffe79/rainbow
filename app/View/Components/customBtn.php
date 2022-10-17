<?php

namespace App\View\Components;

use Illuminate\View\Component;

class customBtn extends Component
{
    public string $text;
    public string $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text,$href)
    {
        $this->text = $text;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.custom-btn');
    }
}
