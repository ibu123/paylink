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

    public function updated()
    {
        if(isset(request()->updates[0]['payload']['name'])) {
            $this->resetValidation(request()->updates[0]['payload']['name']);
        }
    }

    public function addMerchant()
    {

        $this->validate();
        $value = $this->phone_no;
        $env_code = str_replace('+', '', env('COUNTRY_CODE'));

        if(substr($value,0,1) == '+' && !preg_match('/[^0-9]/', substr($value,1)) && strlen((string) $value) == 13) {
            $phone = "0".substr($value,4);
        } elseif (substr($value,0,5) == '00'.$env_code && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 14) {
            $phone = "0".substr($value,5);
        } elseif (substr($value,0,1) == '0' && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 10) {
            $phone = $value;
        }  elseif (substr($value,0,3) == $env_code && !preg_match('/[^0-9]/', $value) && strlen((string) $value) == 12) {
            $phone = "0".substr($value,3);
        } else {
            $this->addError('phone_no', __('Invalid Phone No'));
            return;
        }

        $user = User::updateOrCreate(
        [
            'phone_no' => $phone
        ],[
            'phone_no' => $phone
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

    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function list(Request $request)
    {

        $merchant = Merchant::query()
        ->with('user')
        ->withCount('links as no_of_links')
        ->withSum([
            'links as revenues' => function($q) {
                $q->where('payment_status', 2);
            }
        ],'amount')
        ->withSum('links as net_profit', 'commission')
        ->when(!empty($request->id), function($q) use ($request){
            $commaCount = \Str::substrCount($request->id, ",");
            $arabicCommaCount = \Str::substrCount($request->id, "،");
            $spaceCount = \Str::substrCount($request->id, "-");
            if($commaCount > $arabicCommaCount) {
                if($commaCount >= $spaceCount) {
                    $filterIds = explode(",", trim($request->id, " "));
                } else {
                    $filterIds = explode("-",trim($request->id," "));
                }
            } else {
                if($arabicCommaCount >= $spaceCount) {
                    $filterIds =  explode("،", trim($request->id," "));
                } else {
                    $filterIds =  explode("-",trim($request->id," "));
                }
            }
            $filterIds = array_map('trim', $filterIds);
            $q->whereIn('id', $filterIds );
        })->when(!empty($request->merchant_name), function($q) use ($request){

            $commaCount = \Str::substrCount($request->merchant_name, ",");
            $arabicCommaCount = \Str::substrCount($request->merchant_name, "،");
            $spaceCount = \Str::substrCount($request->merchant_name, "-");

            if($commaCount > $arabicCommaCount) {
                if($commaCount >= $spaceCount) {
                    $merchant_name = explode(",", trim($request->merchant_name, " "));
                } else {
                    $merchant_name =  explode("-",trim($request->merchant_name," "));
                }
            } else {
                if($arabicCommaCount >= $spaceCount) {
                    $merchant_name =  explode("،", trim($request->merchant_name," "));
                } else {
                    $merchant_name =  explode("-",trim($request->merchant_name," "));
                }
            }
            $merchant_name = array_map('trim', $merchant_name);
            $q->whereIn('store_display_name', $merchant_name );
        });

        return Datatables::of($merchant)
        ->addIndexColumn()
        ->editColumn('store_display_name', function($row){
            if(mb_strlen($row->store_display_name) > 5) {
                return "<span class='small__fonts'>".mb_substr($row->store_display_name,0,5,'utf-8').'..</span>';
            }
            return "<span class='small__fonts'>".$row->store_display_name.'</span>';

        })
        ->editColumn('phone_no', function($row){
            return "
                <div class='d-flex cursor__pointer custom__copy__container pos__relative'>
                    <span class='badge badge__toaster badge_toaster_table td_green_color_status' style='left:-7px !important'>
                        انسخ الرابط
                    </span>
                    <span class='small__fonts cursor__pointer copy_text_2'  data-clipboard-action='copy' data-clipboard-text='".$row->user->phone_no."' data-toggle='tooltip' title='".$row->user->phone_no."'>".
                        mb_substr($row->user->phone_no,0,5,'utf-8').'..
                    </span>
                </div>';
        })
        ->editColumn('no_of_links', function($row){
            return $row->no_of_links;
        })
        ->editColumn('revenues', function($row){
            return ($row->revenues ? $row->revenues : 0)." <span>
            ريال
        </span>";
        })
        ->editColumn('net_profit', function($row){
            return ($row->net_profit ? $row->net_profit : 0)." <span>
            ريال
        </span>";
        })
        ->addColumn('action', function ($row) {
            // return '

            // <form method="POST" class="d-flex" action="'.route('send-otp').'">
            // <input type="hidden" name="_token" value="'.csrf_token().'">
            // <input type="hidden" name="phone_no" value="'.$row->user->phone_no.'">
            // <span class="badge view__merchant" id="'.$row->id.'">
            // <img src="'.asset('images/icon/preview.png').'" alt="" >عرض </span>
            // <span class="badge auth__merchant" data-phone="'.$row->user->phone_no.'" id="'.$row->id.'">
            // <img src="'.asset('images/icon/duplicate.png').'" alt="" >تحكم </span>
            // <button type="submit" class="badge">
            //     <img src="'.asset('images/icon/duplicate.png').'" alt=""> تحكم
            // </button>
            // </form>';
            return
            '
            <div class="d-flex">
            <span class="badge view__merchant cursor__pointer" id="'.$row->id.'">
            <img src="'.asset('images/icon/preview.png').'" alt="" >عرض </span>
            <span class="badge auth__merchant cursor__pointer" data-phone="'.$row->user->phone_no.'" id="'.$row->id.'">
            <img src="'.asset('images/icon/duplicate.png').'" alt="" >تحكم </span></div>
            ';
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
            if($import->failures()->isNotEmpty()) {
                foreach ($import->failures() as $key => $failure) {
                    $this->addError('row', __('Row').' '. $failure->row().' '.__('Error').__('Skipped').' '.$failure->errors()[0]);
                }
            } else {

                $this->emit("merchant_created", __("Merchant Data Imported Successfully"));
            }


    }

}
