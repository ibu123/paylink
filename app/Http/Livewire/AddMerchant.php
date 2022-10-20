<?php

namespace App\Http\Livewire;

use App\Models\User;
use ArPHP\I18N\Arabic;
use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Http\File;
use App\Exports\ExcelExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Livewire\WithFileUploads;
use App\Imports\ImportMerchant;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Exceptions\RowSkippedException;

class AddMerchant extends Component
{

    use WithFileUploads;

    public $merchant_name;
    public $cr_number;
    public $vat;
    public $iban;
    public $domain;
    public $phone_no;
    public $store_display_name;
    public $file;

    public function render()
    {
        return view('livewire.add-merchant');
    }

    protected $rules = [
        'merchant_name' => 'required|regex:/^[\pL\s]+$/u',
        'cr_number' => 'required|digits:10',
        'vat' => 'required|digits:15',
        'iban' => 'required|regex:/^[\pL\pN\s]+$/u',
        'domain' => 'required|regex:/^[a-zA-Z0-9.]+$/',
        'phone_no' => 'required|digits:10',
        'store_display_name' => 'required|regex:/^[\pL\s]+$/u|unique:merchants,store_display_name'
    ];

    protected $messages = [
        'merchant_name.*' => 'The Merhchant Name field is required and it only contains letters',
        'cr_number.*' => 'The Commercial No field is required and it must require to have 10 digits',
        'vat.*' => 'The Vat No field is required and it must require to have 15 digits',
        'iban.*' => 'The IBan field is required and it must require to have letters and digits',
        'domain.*' => 'The Domain field is required and it only contains letters, numbers and dot(.).',
        'phone_no.*' => 'The Phone No field is required and it must require to have 10 digits',
        'store_display_name.*' => 'The Store Display Name field is required and it only contains letters',
    ];


    public function updated()
    {
        if(isset(request()->updates[0]['payload']['name'])) {
            $this->resetValidation(request()->updates[0]['payload']['name']);
        }
    }

    public function addMerchant()
    {
        $this->validate();
        $user = User::updateOrCreate(
        [
            'phone_no' => $this->phone_no
        ],[
            'phone_no' => $this->phone_no
        ]);

        Merchant::create([
            'merchant_name' => $this->merchant_name,
            'cr_number' =>  $this->cr_number,
            'user_id' => $user->id,
            'vat' => $this->vat,
            'iban' => $this->iban,
            'domain' => $this->domain,
            'store_display_name' => $this->store_display_name
        ]);
        $this->emit("merchant_created", __("Merchant Created Successfully"));
    }


    public function importMerchant()
    {
        $this->validate();
        $user = User::updateOrCreate(
        [
            'phone_no' => $this->phone_no
        ],[
            'phone_no' => $this->phone_no
        ]);

        Merchant::create([
            'merchant_name' => $this->merchant_name,
            'cr_number' =>  $this->cr_number,
            'user_id' => $user->id,
            'vat' => $this->vat,
            'iban' => $this->iban,
            'domain' => $this->domain,
            'store_display_name' => $this->store_display_name
        ]);
        $this->emit("merchant_created", __("Merchant Created Successfully"));
    }

    public function list(Request $request)
    {
        $merchant = Merchant::query()->with('user');

        return Datatables::of($merchant)
        ->addIndexColumn()
        ->editColumn('store_display_name', function($row){
            return "<span class='small__fonts'>".mb_substr($row->store_display_name,0,5,'utf-8').'..</span>';
        })
        ->editColumn('phone_no', function($row){
            return "<span class='small__fonts'>".mb_substr($row->user->phone_no,0,5,'utf-8').'..</span>';
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
            return '

            <form method="POST" class="d-flex" action="'.route('send-otp').'">
            <input type="hidden" name="_token" value="'.csrf_token().'">
            <input type="hidden" name="phone_no" value="'.$row->user->phone_no.'">
            <span class="badge view__merchant" id="'.$row->id.'">
            <img src="'.asset('images/icon/preview.png').'" alt="" >عرض </span>
            <button type="submit" class="badge">
                <img src="'.asset('images/icon/duplicate.png').'" alt=""> تحكم
            </button>
            </form>';
        })
        ->rawColumns(['net_profit', 'action', 'revenues', 'store_display_name', 'phone_no'])
        ->make(true);

    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);


            $import = new ImportMerchant();
            $import->import($this->file);

            if(!empty($import->failures())) {
                foreach ($import->failures() as $key => $failure) {
                    $this->addError('row', 'row '.$failure->row().' skipped - error -'.$failure->errors()[0]);
                }
            } else {
                $this->emit("merchant_created", __("Merchant Added Successfully"));
            }


    }

}
