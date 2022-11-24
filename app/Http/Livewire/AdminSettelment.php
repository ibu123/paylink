<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Models\Paylink;

class AdminSettelment extends Component
{

    public $merhcantId;
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
            "items" => $merchantLists->getCollection()
        ]);
    }

    public function payLinkList(Request $request)
    {
        $merchantLists = Paylink::
        with(['store', 'paylinkInvoice', 'sellerInvoice'])
        ->when(!empty($request->q), function($query) use ($request){
            $query->where('id', 'like', '%'.$request->q.'%');
        })->paginate(8);
        // dd($merchantLists);
        return response()->json([
            "items" => $merchantLists->getCollection(),
            "page" => $merchantLists->currentPage(),
            "total_count" => $merchantLists->lastPage(),
        ]);
    }
}
