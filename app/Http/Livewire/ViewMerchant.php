<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Merchant;
use Livewire\Component;

class ViewMerchant extends Component
{

    protected $listeners = [
        'view_merchant' => 'viewMerchant',
    ];

    public $merchant_name;
    public $cr_number;
    public $vat;
    public $iban;
    public $domain;
    public $phone_no;
    public $store_display_name;



    public function render()
    {
        return view('livewire.view-merchant');
    }

    public function viewMerchant($id)
    {
        $merhchant = Merchant::find($id);
        $this->merchant_name = $merhchant->merchant_name;
        $this->cr_number = $merhchant->cr_number;
        $this->vat = $merhchant->vat;
        $this->iban = $merhchant->iban;
        $this->domain = $merhchant->domain;
        $this->phone_no = $merhchant->user->phone_no;
        $this->store_display_name = $merhchant->store_display_name;
        $this->emit('merchant_popup');
    }
}
