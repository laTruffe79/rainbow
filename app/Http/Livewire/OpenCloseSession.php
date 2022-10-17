<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OpenCloseSession extends Component
{

    public $session;
    public $open;

    public function mount()
    {
        $this->open = $this->session->open === 1 ? true : false;
    }

    public function updatedOpen()
    {
        $this->session->open = $this->open;
        $this->session->save();
    }

    public function render()
    {
        return view('livewire.open-close-session');
    }
}
