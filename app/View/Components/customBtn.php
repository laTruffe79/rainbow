<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class customBtn extends Component
{
    public string $text;
    public string $href;
    public string $icon;
    public string $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $icon, string $text, string $href, ?bool $disabled = false)
    {
        $this->text = $text;
        $this->href = $href;
        $this->icon = $icon;
        $this->disabled = $disabled;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.custom-btn');
    }
}
