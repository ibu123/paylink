<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FiltersMerchant extends Component
{

    public $merchantId;

    protected $rules = [
        'merchantId' => 'nullable|regex:/^[0-9,]+$/'
    ];

    public function messages()
    {
        return [
            'merchantId.*' => __('The merhcant Id field only contains digits and comma(,) with no sapce')
        ];
    }

    public function render()
    {
        return view('livewire.filters-merchant');
    }

    public function filters()
    {
        $this->validate();
        $this->emit("redraw-DataTable", $this->merchantId );

    }
}
