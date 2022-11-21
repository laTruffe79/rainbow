<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OpenCloseSession extends Component
{

    public $session;
    public $open;

    public function mount($session)
    {

        $this->session = \App\Models\Session::findOrfail($session);
        //dd($this->session);
        $this->open = $this->session->open === 1;
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
