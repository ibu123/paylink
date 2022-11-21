<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FilterLinks extends Component
{

    public $linkId = '';
    public $status = '';
    public $amountFrom = '';
    public $amountTo = '';

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }


    public function render()
    {
        return view('livewire.filter-links');
    }

    public function filters()
    {
        // $this->validate();
        $this->emit("redraw-DataTable",
            $this->linkId ,
            $this->status,
            $this->amountFrom,
            $this->amountTo

        );

    }
}
