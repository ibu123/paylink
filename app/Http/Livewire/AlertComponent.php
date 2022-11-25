<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertComponent extends Component
{
    protected $listeners = [
        'merchant_created' => 'showFlashSession',
        'link_created' => 'showFlashSession',
        'settelment_done' => 'showFlashSession'
    ];



    public function render()
    {
        return view('livewire.alert-component');
    }

    public function showFlashSession($message)
    {
        session()->flash('message', $message);
        $this->emit('flash_hide');
    }
}
