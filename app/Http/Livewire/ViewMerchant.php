<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ViewMerchant extends Component
{

    protected $listeners = [
        'view_merchant' => 'viewMerchant',
        'refershComponent' => '$refresh'
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
        $user = User::find($id);
        $this->merchant_name = $user->name;
        $this->cr_number = $user->cr_number;
        $this->vat = $user->vat;
        $this->iban = $user->iban;
        $this->domain = $user->domain;
        $this->phone_no = $user->phone_no;
        $this->store_display_name = $user->store_display_name;
        $this->emit('merchant_popup');
    }
}
