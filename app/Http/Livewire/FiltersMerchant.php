<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FiltersMerchant extends Component
{

    public $merchantId = '';
    public $merchantName = '';

    protected $rules = [
        'merchantId' => 'nullable|regex:/^[0-9,،-]+$/',
        'merchantName' => 'nullable'
    ];

    public function messages()
    {
        return [
            'merchantId.*' => __('The merhcant Id field only contains digits and comma(,) with no sapce')
        ];
    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.filters-merchant');
    }

    public function filters()
    {
        $this->validate();
        $this->emit("redraw-DataTable", $this->merchantId , $this->merchantName);

    }
}
