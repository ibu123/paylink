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
    public $merchant_name_edit = 0;

    public $cr_number;
    public $cr_number_edit = 0;

    public $vat;
    public $vat_edit = 0;

    public $iban;
    public $iban_edit = 0;

    public $domain;
    public $domain_edit = 0;

    public $store_display_name;
    public $store_display_name_edit = 0;

    public $mId = 0;


    public function messages() {

        return [
            'merchant_name.*' => __('The Merchant Name field is required and it only contains letters'),
            'cr_number.*' => __('The Commercial No field is required and must be digits'),
            'vat.*' => __('The Vat No field is required and must be digits'),
            'iban.*' => __('The IBan field is required and it must require to have letters and digits'),
            'domain.required' => __('The Domain field is required and it only contains letters, numbers and dashes(-)'),
            'domain.regexp' => __('The Domain field is required and it only contains letters, numbers and dashes(-)'),
            'domain.unique' => __('The Same Domain Already Exist'),
            'phone_no.*' => __('Invalid Phone No'),
            'store_display_name.required' => __('The Store Display Name field is required and it only contains letters'),
            'store_display_name.regex' => __('The Store Display Name field is required and it only contains letters'),
            'store_display_name.unique' => __('The Store Display Name Requires to be unique')

        ];
    }


    public function rules()
    {
        $env_code = str_replace('+', '', env('COUNTRY_CODE'));

        return [
            'merchant_name' => 'required|regex:/^[\pL\s]+$/u',
            'cr_number' => 'required|integer',
            'vat' => 'required|integer',
            'iban' => 'required|regex:/^[\pL\pN\s]+$/u',
            'domain' => 'required|unique:merchants,domain|regex:/^[a-zA-Z0-9-]+$/',
            'phone_no' => ['required', function($attribute, $value, $fail) use ($env_code){
                if(substr($value,0,1) == '+' &&  (preg_match('/[^0-9]/', substr($value,1)) || strlen((string) $value) != 13)) {
                    $fail(__('Invalid Phone No'));
                } elseif (substr($value,0,5) == '00'.$env_code && (preg_match('/[^0-9]/', $value) || strlen((string) $value) != 14)) {
                    $fail(__('Invalid Phone No'));
                } elseif (substr($value,0,1) == '0' && substr($value,0,1) != '0' && (preg_match('/[^0-9]/', $value) || strlen((string) $value) != 11)) {
                    $fail(__('Invalid Phone No'));
                }  elseif (substr($value,0,3) == $env_code && (preg_match('/[^0-9]/', $value) || strlen((string) $value) != 12)) {
                    $fail(__('Invalid Phone No'));
                } elseif (substr($value,0,1) != '+' && substr($value,0,2) != '00' && substr($value,0,1) != '0' && substr($value,0,3) != '966') {
                    $fail(__('Invalid Phone No'));
                }
            }, function($attribute, $value, $fail){
                if($value == \Auth::user()->phone_no) {
                    $fail(__('Admin is not able to create store for himself'));
                }
            }],
            'store_display_name' => 'required|unique:merchants,store_display_name'
        ];
    }


    public function render()
    {
        return view('livewire.view-merchant');
    }

    public function updated()
    {
        if(isset(request()->updates[0]['payload']['name'])) {
            $this->{request()->updates[0]['payload']['name']."_edit"} = 1;
            $this->resetValidation(request()->updates[0]['payload']['name']);
        }
    }

    public function update($field)
    {

        $this->validateOnly($field);

        Merchant::findOrFail($this->mId)->update([
            $field => $this->{$field}
        ]);

        $this->{$field."_edit"} = 0;

    }

    public function viewMerchant($id)
    {
        $merhchant = Merchant::find($id);
        $this->mId = $id;
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
