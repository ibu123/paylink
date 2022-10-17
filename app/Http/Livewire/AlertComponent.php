<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AlertComponent extends Component
{
    protected $listeners = ['postAdded' => 'incrementPostCount'];

    public $count = 5;

    public function render()
    {
        return view('livewire.alert-component');
    }

    public function incrementPostCount()
    {
        $this->count = 6;
        session()->flash('message', 'Post successfully updated.');
    }
}
