<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Paylink;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\SellerInvoice;
use App\Models\PaylinkInvoice;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Http;

class ViewLinks extends Component
{

    public $linkId = '';
    public $amount = '';
    public $paymentStatus = '';
    public $receivingStatus = '';
    public $expirationTime = '';
    public $notes = '';
    public $linkUrl = '';
    public $orderId = '';

    protected $listeners = [
        'view_link' => 'viewLink',
    ];

    public function render()
    {
        return view('livewire.view-links');
    }

    public function links(Request $request)
    {
        $paylink = PayLink::query()
        ->with('store')
        ->select('*')
        ->addSelect(\DB::raw('TIMESTAMPDIFF(SECOND, FROM_UNIXTIME(UNIX_TIMESTAMP()) , expiration_date ) AS expired'))
        ->when(!empty($request->id), function($q) use ($request){
            $q->whereIn('id', explode(",",$request->id));
        })->when(!empty($request->status), function($q) use ($request){
            $q->whereIn('payment_status', $request->status);
        })->when(!empty($request->status) && in_array(3, $request->status), function($q){
            $q->orWhere(function($q) {
                $q->whereRaw('TIMESTAMPDIFF(SECOND, FROM_UNIXTIME(UNIX_TIMESTAMP()) , expiration_date ) < 0');
            });
        })->when(!empty($request->status) && in_array(4, $request->status), function($q){
            $q->orWhere(function($q) {
                $q->where([
                    'payment_status' => 2,
                    'send_payment_status' => 2
                ]);
            });
        })
        ->when(!empty($request->amount_from), function($q) use ($request){
            $q->where('amount', '>=', $request->amount_from);
        })->when(!empty($request->amount_to), function($q) use ($request){
            $q->where('amount', '<=', $request->amount_to);
        });
        // dd($paylink->get());
        return Datatables::of($paylink)
        ->addIndexColumn()
        ->editColumn('amount', function($row){
            return $row->amount." <span>
            ريال
        </span>";

        })
        ->editColumn('payment_status', function($row){
            $date = Carbon::parse($row->expiration_date);
            $now = Carbon::now();
            $expirationTime = '';
            if($now->gt($date)) {
                $expirationTime = '';
            } else {
                $diff = $date->diff($now);
                $expirationTime = json_encode($diff);
            }

            if($row->payment_status == 0) {
                return "<span class='td__badge td__black'>ملغي</span>";
            } elseif($row->payment_status == 1 && !empty($expirationTime)) {
                return "<span class='td__badge td__orange'>بانتظار الدفع</span>";
            } elseif($row->payment_status == 1 && empty($expirationTime)) {
                return "<span class='td__badge td__expire'>منتهي الصلاحية</span>";
            } elseif($row->payment_status == 2) {
                return "<span class='td__badge'>تم الدفع</span>";
            } else {
                return $row->payment_status;
            }
        })
        ->editColumn('send_payment_status', function($row){
            $date = Carbon::parse($row->expiration_date);
            $now = Carbon::now();
            $expirationTime = '';
            if($now->gt($date)) {
                $expirationTime = '';
            } else {
                $diff = $date->diff($now);
                $expirationTime = json_encode($diff);
            }
            if($row->send_payment_status == 0) {
                return "<span class='td__badge td__black'>ملغي</span>";
            } elseif($row->send_payment_status == 1  && !empty($expirationTime)) {
                return "<span class='td__badge td__orange'>غير مستلم</span>";
            } elseif($row->send_payment_status == 1 && $row->payment_status == 1 && empty($expirationTime)) {
                return "<span class='td__badge td__expire'>منتهي الصلاحية</span>";
            } elseif($row->send_payment_status == 1 && $row->payment_status == 2) {
                return "<span class='td__badge td__orange'>غير مستلم</span>";
            } elseif($row->send_payment_status == 2) {
                return "<span class='td__badge td__send__success'>تم الاستلام</span>";
            } else {
                return $row->send_payment_status;
            }
        })
        ->addColumn('action', function ($row) {
            $linkUrl = route('checkout', [ 'store' => $row->store->domain,  'orderId' => $row->order_id]);
            if($row->payment_status == 2) {
                return '<div class="d-flex justify-content-center cursor__pointer custom__copy__container pos__relative" >
                <span class="badge badge__toaster badge_toaster_table td_green_color_status">
                                            انسخ الرابط
                                        </span>
                    <span class="badge view__link" id ="'.$row->id.'">
                        <img src="'.asset('images/icon/preview.png').'" alt="">عرض
                    </span>
                    <span class="badge copy_text_2"  data-clipboard-action="copy"


                    data-clipboard-text="'.$linkUrl.'" >
                        <img src="'.asset('images/icon/duplicate.png').'" alt=""> نسخ
                    </span>
                    <span class="badge"  onclick="window.open(\''.route("seller.invoice", ["orderId" => $row->order_id]) .'\', \'_blank\')">
                        <img src="'.asset('images/icon/export copy_1x.png').'" alt=""> تصدير
                    </span>
                </div>';
            }

            return '<div class="d-flex justify-content-center cursor__pointer custom__copy__container pos__relative" >
                <span class="badge badge__toaster badge_toaster_table td_green_color_status">
                                            انسخ الرابط
                                        </span>
                    <span class="badge view__link" id ="'.$row->id.'">
                        <img src="'.asset('images/icon/preview.png').'" alt="">عرض
                    </span>
                    <span class="badge copy_text_2"  data-clipboard-action="copy"


                    data-clipboard-text="'.$linkUrl.'" >
                        <img src="'.asset('images/icon/duplicate.png').'" alt=""> نسخ
                    </span>
                    <span class="badge disable__op" >
                        <img src="'.asset('images/icon/export copy_1x.png').'" alt=""> تصدير
                    </span>
                </div>';
            // return '


        })
        ->rawColumns(['action', 'amount', 'send_payment_status', 'payment_status'])
        ->make(true);
    }

    public function viewLink($id)
    {

        $paylink = Paylink::with('store')->where('id', $id)->firstOrFail();

        $date = Carbon::parse($paylink->expiration_date);
        $now = Carbon::now();

        if($now->gt($date)) {
            $this->expirationTime = '';
        } else {

            $diff = $date->diff($now);
            $this->expirationTime = json_encode($diff);
        }
        $this->linkId = $paylink->id;
        $this->amount = $paylink->amount;
        $this->paymentStatus = $paylink->payment_status;
        $this->receivingStatus = $paylink->send_payment_status;
        $this->orderId = $paylink->order_id;
        $this->notes = $paylink->notes;
        $this->linkUrl = route('checkout', [ 'store' => $paylink->store->domain,  'orderId' => $paylink->order_id]);
        $this->emit('viewlink_popup', $this->linkId);
    }

    public function checkout($store, $orderId)
    {
        $paylink = Paylink::where('order_id', $orderId)->firstOrFail();
        $date = Carbon::parse($paylink->expiration_date);
        $now = Carbon::now();
        $expirationTime = '';

        if($now->gt($date)) {
            $expirationTime = '';
        } else {
            $diff = $date->diff($now);
            $expirationTime = json_encode($diff);
        }
        if(!empty($paylink->checkout_url) && !empty($expirationTime)) {
            return redirect()->to($paylink->checkout_url);
        }

        return abort(403, __('Link Is Expired'));

    }


    public function capture(Request $request) {
        $key = "Key_Test ".base64_encode("munat.oun:3ca4d2bfd1bb431d9a355e8f74dfc54d");
        $orderId = $request->orderId;

        $response = Http::
        withHeaders([
            "Content-type" => "application/json",
            "Authorization" => $key
        ])->get('https://api-stg.noonpayments.com/payment/v1/order/'.$orderId);

        $response = $response->object();
        // dd($response);
        if (isset($response->result->transactions[0]) && $response->result->transactions[0]->status == 'SUCCESS') {
            $commissionPercentage = ($response->result->paymentDetails->brand == 'VISA' || $response->result->paymentDetails->brand == 'MASTERCARD') ? 2.7 : 3.5;

            $paylink = Paylink::where('order_id', $orderId)->first();
            $paylink->update([
                'payment_status' => 2,
                // 'send_payment_status' => 2,
                'paid_date' => Carbon::now(),
                'send_paid_date' => Carbon::now(),
                'card' => $response->result->paymentDetails->brand,
                'commission_percentage' => $commissionPercentage,
                'commission' => $response->result->order->amount * $commissionPercentage / 100
            ]);

            PaylinkInvoice::updateOrCreate(
                [
                    'paylink_id' => $paylink->id
                ],
                [
                    'paylink_id' => $paylink->id
                ]
            );

            SellerInvoice::updateOrCreate(
                [
                    'paylink_id' => $paylink->id
                ],
                [
                    'paylink_id' => $paylink->id
                ]
            );

            return redirect()->to(route('success', ['orderId' => $orderId]));
        }

        Paylink::where('order_id', $orderId)->update([
            'payment_status' => 0,
            'send_payment_status' => 0
        ]);

        abort(403, $response->result->order->errorMessage);
    }

    public function success($orderId = '') {
        // dd(Carbon::now());
        $paylink = Paylink::with('store')->where('order_id', $orderId)->firstOrFail();
        return view('success', compact('paylink','orderId'));
    }

    public function expireLink() {
        if($this->paymentStatus == 1 && !empty($this->expirationTime))
        {
            $this->paymentStatus = 0;
            $this->receivingStatus = 0;
            Paylink::where('order_id', $this->orderId)->update([
                'payment_status' => 0,
                'send_payment_status' => 0
            ]);
        }
    }
}
