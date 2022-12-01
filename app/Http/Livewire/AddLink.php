<?php

namespace App\Http\Livewire;

use App\Models\Paylink;
use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use ArPHP\I18N\Arabic;

class AddLink extends Component
{

    public $amount;
    public $link_validity;
    public $notes;

    public function rules()
    {
        return [
            "amount" => "required|integer",
            "link_validity" => "required|integer",
            "notes" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            "amount.*" => __("المبلغ المطلوب is required must be a number"),
            "link_validity.*" => __("صلاحية الرابط is required must be a number")
        ];
    }


    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.add-link');
    }

    public function submit()
    {
        $this->validate();
        $key = "Key_Test ".base64_encode("munat.oun:3ca4d2bfd1bb431d9a355e8f74dfc54d");
        $store = \Session::get('store');

        $arabic = new Arabic();
        if(isset($store))
        {
            $store = Merchant::find(\Session::get('store'));
        }
        // dd(preg_replace('/[^0-9a-zA-Z]/','',$arabic->ar2en($store->store_display_name))) ;

        $postJson = [
            "apiOperation" => "INITIATE",
            "order" => [
                "reference" => isset($store) ? $store->id : '',
                "amount" => $this->amount,
                "currency" => "SAR",
                "name" => isset($store) ? preg_replace('/[^0-9a-zA-Z]/','',$arabic->ar2en($store->store_display_name)) : 'Test',
                "channel" => "web",
                "category" => "pay",

            ],
            "configuration" => [
                "locale" => "ar",
                "paymentAction" => "SALE",
                "returnUrl" => route('capture')
            ],
            "merchantDescriptor" => [
                "name" => isset($store) ? preg_replace('/[^0-9a-zA-Z]/','',$arabic->ar2en( $store->merchant_name )): 'Test',
                "legalName" => isset($store) ?  preg_replace('/[^0-9a-zA-Z]/','',$arabic->ar2en($store->store_display_name)) : 'Test',
            ]
        ];
        $response = Http::
        withHeaders([
            "Content-type" => "application/json",
            "Authorization" => $key
        ])->post('https://api-stg.noonpayments.com/payment/v1/order', $postJson);

        $response = $response->object();
         
        if ($response->resultCode == 0) {
            \DB::enableQueryLog(); // Enable query log

// Your Eloquent query executed by using get()

// dd(); // Show results of log
            $paylink = Paylink::create([
                'store_id' =>  isset($store) ? $store->id : 1,
                'order_id' => \DB::raw($response->result->order->id),
                'amount' => $this->amount,
                'checkout_url' =>  $response->result->checkoutData->postUrl,
                'expiration_date' => Carbon::now()->addSeconds($this->link_validity)->toDateTimeString(),
                'notes' => $this->notes,
                'payment_status' => 1,
                'send_payment_status' => 1
            ]);
            // dump(\DB::getQueryLog(), $response->result->order->id, $paylink);
            if($paylink)
            {
                return $this->emit("link_created", __("Link Created Successfully"));
            }
        }

        return $this->addError("server_down", __("Payment Server Down"));
    }
}
