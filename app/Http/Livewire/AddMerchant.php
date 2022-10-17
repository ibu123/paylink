<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddMerchant extends Component
{
    public function render()
    {
        return view('livewire.add-merchant');
    }
    public $merchant_name;
    protected $rules = [
        'merchant_name' => 'required|min:6',
    ];

    public function updated()
    {
        $this->resetValidation();
    }

    public function addMerchant()
    {
        $this->validate();
        session()->flash('message', 'Post successfully updated.');
        $this->emit("postAdded");
    }
}
