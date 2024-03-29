<?php

namespace App\Http\Livewire;

use App\Models\Paylink;
use ArPHP\I18N\Arabic;
use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminSettelment extends Component
{

    public $merchantId;
    public $paylinkId;
    public $date_range;

    public function rules() {
        return [
            'merchantId' => 'required',
            'paylinkId' => Rule::requiredIf(!$this->date_range),
            'date_range' => Rule::requiredIf(!$this->paylinkId)
        ];
    }

    public function messages()
    {
        return [
            'merchantId.*' => __('Please Select At Least One merchant for settlement'),
            'paylinkId.*' => __('Please Select Either Paylink Id OR select data range'),
            'date_range.*' => __('Please Select Either Paylink Id OR select data range')
        ];
    }


    public function render()
    {
        return view('livewire.admin-settelment');
    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function updated()
    {
        // dd(request()->updates);  // DD("EEEE");
        if(isset(request()->updates[0]['payload']['name'])) {
            $this->resetValidation(request()->updates[0]['payload']['name']);
        }

        if(isset(request()->updates[0]['payload']['method']) && request()->updates[0]['payload']['method'] == '$set' ) {
            $this->resetValidation(request()->updates[0]['payload']['params'][0]);
        }
    }

    public function merchantList(Request $request)
    {
        $merchantLists = Merchant::
        when(!empty($request->q), function($query) use ($request){
            $query->where('store_display_name', 'like', '%'.$request->q.'%')
            ->orWhere('id', 'like', '%'.$request->q.'%');
        })->paginate(30);
        $merchant = new Merchant();
        $merchant->id = -1;
        $finalData = [];
        $collection = $merchantLists->getCollection();
        if($collection->isNotEmpty())
        {
            $finalData = $merchantLists->getCollection()->prepend($merchant);
        }


        return response()->json([
            "items" => $finalData,
            "page" => $merchantLists->currentPage(),
            "total_count" => $merchantLists->lastPage(),
        ]);
    }

    public function payLinkList(Request $request)
    {
        $merchantLists = Paylink::
        with(['store', 'paylinkInvoice', 'sellerInvoice'])
        ->where('payment_status', 2)
        ->where('send_payment_status', '!=', 2)
        ->when(!empty($request->merchantId) && !in_array(-1,$request->merchantId) , function($q) use ($request){
            $q->whereIn('store_id', $request->merchantId);
        })
        ->when(!empty($request->q), function($query) use ($request){
            $query->where('id', 'like', '%'.$request->q.'%');
        })->paginate(30);

        $paylink = new Paylink();
        $paylink->id = -1;
        $finalData = [];
        $collection = $merchantLists->getCollection();
        if($collection->isNotEmpty())
        {
            $finalData = $merchantLists->getCollection()->prepend($paylink);
        }
        return response()->json([
            "items" => $finalData,
            "page" => $merchantLists->currentPage(),
            "total_count" => $merchantLists->lastPage(),
        ]);
    }

    public function settelment()
    {
        // dd($this);
        $this->validate();
        $result = Paylink::when(!in_array(-1, $this->merchantId), function($q){
            $q->whereIn('store_id', $this->merchantId);
        })->where(function($q){
            $q->when(!empty($this->paylinkId) && !in_array(-1, $this->paylinkId), function($q){
                $q->whereIn('id', $this->paylinkId);
            })->when(!empty($this->date_range), function($q){

                    $temp = explode(" - ", $this->date_range);
                    $fromDate = $temp[0];
                    $toDate = $temp[1];
                    $q->where('paid_date','>=', \Carbon\Carbon::parse($fromDate))
                    ->where('paid_date','<=', \Carbon\Carbon::parse($toDate));
            });
        })->update([
            'send_payment_status' => 2
        ]);

        $this->emit("settelment_done", __("All Merchant Settelment Done"));
        //https://dev.to/marinamosti/removing-duplicates-in-an-array-of-objects-in-js-with-sets-3fep
    }

    public function exportSettelment()
    {
        $this->validate();
        $result = Merchant::
        with('user')
        ->whereHas('links', function($q){
            $q->where('payment_status', 2)
            ->where('send_payment_status', '!=', 2);
        })
        ->withSum(['links as due_amount'=> function($q){

                $q->when(!empty($this->paylinkId) && !in_array(-1, $this->paylinkId), function($q){
                    $q->whereIn('id', $this->paylinkId);
                })->when(!empty($this->date_range), function($q){

                        $temp = explode(" - ", $this->date_range);
                        $fromDate = $temp[0];
                        $toDate = $temp[1];
                        $q->where('paid_date','>=', \Carbon\Carbon::parse($fromDate))
                        ->where('paid_date','<=', \Carbon\Carbon::parse($toDate));
                })
                ->where('payment_status', 2)
                ->where('send_payment_status', '!=', 2);
            }
        ], 'amount')
        ->withSum(['links as commission_amount'=> function($q){

                $q->when(!empty($this->paylinkId) && !in_array(-1, $this->paylinkId), function($q){
                    $q->whereIn('id', $this->paylinkId);
                })->when(!empty($this->date_range), function($q){

                        $temp = explode(" - ", $this->date_range);
                        $fromDate = $temp[0];
                        $toDate = $temp[1];
                        $q->where('paid_date','>=', \Carbon\Carbon::parse($fromDate))
                        ->where('paid_date','<=', \Carbon\Carbon::parse($toDate));
                })
                ->where('payment_status', 2)
                ->where('send_payment_status', '!=', 2);
            }
        ], 'commission')
        ->when(!in_array(-1, $this->merchantId), function($q){
            $q->whereIn('id', $this->merchantId);
        })->get();
        // dd($result);
        if($result->isEmpty()) {
            return $this->addError('no-filter-match', __('No Filter Match'));

        }

        $html = View::make('exports.settelment', ['settelments' => $result ])->render();

        $arabic = new Arabic();
        $p = $arabic->arIdentify($html);
        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
            $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }
        $pdf = Pdf::setOption([
            'enable_php' => true,
        ])->setPaper('a4', 'landscape')->loadHtml($html);
        $output = $pdf->output();

        return response()->streamDownload(function () use ($output){
            echo $output;
        }, 'export.pdf');
    }
}
