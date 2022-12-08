<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Validation\Rule;

class AuthMerchantComponent extends Component
{

    public $store;
    public $phoneNo;
    public $stores = [];
    public $otp = null;
    public $inputStatus = false;
    public $staticPhoneNo = '';
    public $readOnly = false;

    public function __construct($items)
    {
        $this->stores = collect([]);
    }


    public function rules()
    {
        $env_code =str_replace('+', ' ', env('COUNTRY_CODE'));
        // 00966551234567 //14
        // 966551234567 // 12
        // 0551234567 // 10
        // +966551234567 // 13
        return [
            'phoneNo' => ['required',  function($attribute, $value, $fail) use ($env_code){
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
            }],
            "otp" => "required|digits:4",
            "store" => Rule::requiredIf(\Session::get('has_store') == 1)
        ];
    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function messages()
    {
        return  [
            'phoneNo.*' => __('Invalid Phone No'),
            'otp.*' => __( "The OTP field is required and it must require to have 4 digits"),
            'store.*' => __( "Please Select At Least one store")
        ];
    }

    public function updated()
    {
        if(isset(request()->updates[0]['payload']['name'])) {
            $this->resetValidation(request()->updates[0]['payload']['name']);
        }
    }

    public function updatedphoneNo()
    {
       $this->inputStatus = false;
    }


    public function render()
    {
        return view('livewire.auth-merchant-component');
    }

    public function sendOTP()
    {
        $this->validateOnly('phoneNo');
        $env_code = str_replace('+', '', env('COUNTRY_CODE'));

        $value = $this->phoneNo;
        if(substr($value,0,1) == '+' && !preg_match('/[^0-9]/', substr($value,1)) && strlen((string) $value) == 13) {
            $phone = "0".substr($value,4);
        } elseif (substr($value,0,5) == '00'.$env_code && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 14) {
            $phone = "0".substr($value,5);
        } elseif (substr($value,0,1) == '0' && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 10) {
            $phone = $value;
        }  elseif (substr($value,0,3) == $env_code && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 12) {
            $phone = "0".substr($value,3);
        } else {
            $this->addError('phoneNo', __('Invalid Phone No'));
            return;
        }

        $phone_no = env('COUNTRY_CODE').$phone;
        $user = User::where('phone_no', $phone)
        ->where('type', 1)
        ->first();

        if(!$user) {
            $this->addError('phoneNo', __('Invalid Phone No'));
            return;
        }
        // $phone_no = "";
        // $phone = "9173286350";
        $this->stores = Merchant::where('user_id', $user->id)->get();
        if($this->stores->isNotEmpty() && $this->stores->count() > 1) {
            \Session::put('has_store' , 1);
        } else {
            \Session::put('has_store' , 0);
            $this->stores = collect([]);
        }
        $this->inputStatus = true;

        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }

        $this->staticPhoneNo = $phone_no;

        if(sendOTP($this->staticPhoneNo))
        {
            \Session::put('phone_no', $phone);
            $this->inputStatus = true;
        }
    }

    public function verifyOTP() {
        $this->validate();
        \Session::forget('store');

        if(verifyOTP($this->otp, $this->staticPhoneNo))
        {
            \Session::put('store', $this->store);
            $user = User::where('phone_no', \Session::get('phone_no'))->first();
            \Auth::login($user);
            if(\Auth::user()->type == 1) {
                return redirect()->route('merchant.dashboard');
            }
            return redirect()->route('admin.dashboard');
        }

        $this->addError('otp', __('Invalid OTP'));
    }

    public function reSendOTP() {
        $this->validateOnly('phoneNo');
        $phone_no = $this->staticPhoneNo;
        if(\Auth::check() && \Auth::user()->type == 0) {
            $phone_no = env('COUNTRY_CODE').\Auth::user()->phone_no;
        }

        if(sendOTP($phone_no))
        {
            \Session::put('phone_no', \Session::get('phone_no'));
        }
    }
}
