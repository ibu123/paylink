<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Yajra\Datatables\Datatables;

class AddMerchant extends Component
{

    public $merchant_name;
    public $cr_number;
    public $vat;
    public $iban;
    public $domain;
    public $phone_no;
    public $store_display_name;

    public function render()
    {
        return view('livewire.add-merchant');
    }

    protected $rules = [
        'merchant_name' => 'required',
        'cr_number' => 'required',
        'vat' => 'required',
        'iban' => 'required',
        'domain' => 'required',
        'phone_no' => 'required',
        'store_display_name' => 'required'
    ];

    public function updated()
    {
        $this->resetValidation(request()->updates[0]['payload']['name']);
    }

    public function addMerchant()
    {
        $this->validate();
        User::create([
            'name' => $this->merchant_name,
            'cr_number' =>  $this->cr_number,
            'vat' => $this->vat,
            'iban' => $this->iban,
            'domain' => $this->domain,
            'phone_no' => $this->phone_no,
            'store_display_name' => $this->store_display_name
        ]);
        $this->emit("merchant_created", __("Merchant Created Successfully"));
    }

    public function list(Request $request)
    {
        return Datatables::of(User::query())
        ->addIndexColumn()
        ->editColumn('name', function($row){
            return substr($row->name, 0, 5)."..";
        })
        ->editColumn('no_of_links', function($row){
            return 0;
        })
        ->editColumn('revenues', function($row){
            return "45k <span>
            ريال
        </span>";
        })
        ->editColumn('net_profit', function($row){
            return "45k <span>
            ريال
        </span>";
        })
        ->addColumn('action', function ($row) {
            return ' <span class="badge view__merchant" id="'.$row->id.'">
            <img src="'.asset('images/icon/preview.png').'" alt="" >عرض </span>
            <span class="badge">
                <img src="'.asset('images/icon/duplicate.png').'" alt=""> تحكم</span>';
        })
        ->rawColumns(['net_profit', 'action', 'revenues'])
        ->make(true);

    }
}
