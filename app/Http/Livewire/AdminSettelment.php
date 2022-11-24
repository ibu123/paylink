<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Models\Paylink;

class AdminSettelment extends Component
{

    public $merchantId;
    public $paylinkId;
    public $date_range;

    public function render()
    {
        return view('livewire.admin-settelment');
    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function merchantList(Request $request)
    {
        $merchantLists = Merchant::
        when(!empty($request->q), function($query) use ($request){
            $query->where('store_display_name', 'like', '%'.$request->q.'%')
            ->orWhere('id', 'like', '%'.$request->q.'%');
        })->paginate(30);

        return response()->json([
            "items" => $merchantLists->getCollection(),
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
        ->when(!empty($this->merchantId) && in_array(-1, $this->merchantId) , function($q) {
            $q->whereIn('store_id', $this->merchantId);
        })
        ->when(!empty($request->q), function($query) use ($request){
            $query->where('id', 'like', '%'.$request->q.'%');
        })->paginate(30);

        $paylink = new Paylink();
        $paylink->id = -1;
        return response()->json([
            "items" => $merchantLists->getCollection()->prepend($paylink),
            "page" => $merchantLists->currentPage(),
            "total_count" => $merchantLists->lastPage(),
        ]);
    }
}
