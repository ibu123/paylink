<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use ArPHP\I18N\Arabic;
use Livewire\Component;
use App\Models\Merchant;
use App\Exports\ExcelExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class ExportMerchant extends Component
{

    public $merchantId;
    public $column = [];
    public $date_range;
    public $type = [];

    protected $rules = [
        'merchantId' => 'nullable|regex:/^[0-9,،-]+$/',
        'type' => 'required'
    ];

    public function messages()
    {
        return [
            'merchantId.*' => __('The merhcant Id field only contains digits and comma(,) with no sapce'),
            'type.*' => __('Please select at least one option')
        ];
    }

    public function render()
    {
        return view('livewire.export-merchant');
    }


    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function export()
    {
        $temp = explode(" - ",$this->date_range);
        $fromDate = "";
        $toDate = "";

        if(!empty($this->date_range)) {
            $fromDate = $temp[0];
            $toDate = $temp[1];
        }
        $this->validate();
        // $temporaryDirectory = (new TemporaryDirectory())->create();
        // $rows = $this->rows;
        $data = Merchant::with('user')
        ->withCount('links as no_of_links')
        ->withSum('links as revenues', 'amount')
        ->withSum('links as net_profit', 'commission')
        ->when(!empty($this->merchantId), function($q){
            $commaCount = \Str::substrCount($this->merchantId, ",");
            $arabicCommaCount = \Str::substrCount($this->merchantId, "،");
            $spaceCount = \Str::substrCount($this->merchantId, "-");
            if($commaCount > $arabicCommaCount) {
                if($commaCount >= $spaceCount) {
                    $filterIds = explode(",", trim($this->merchantId, " "));
                } else {
                    $filterIds = explode("-",trim($this->merchantId," "));
                }
            } else {
                if($arabicCommaCount >= $spaceCount) {
                    $filterIds =  explode("،", trim($this->merchantId," "));
                } else {
                    $filterIds =  explode("-",trim($this->merchantId," "));
                }
            }
            $filterIds = array_map('trim', $filterIds);
            $q->whereIn('id', $filterIds );
        })
        ->when(!empty($this->date_range), function($q) use ($temp, $fromDate, $toDate){
            $q->where('created_at', '>=', Carbon::parse($fromDate))
            ->where('created_at', '<=', Carbon::parse($toDate));
        })
        ->get();

        if($data->isEmpty()) {
            return $this->addError('no-filter-match', __('No Filter Match'));

        }
        if(in_array(1, $this->type)) {
            $excel = Excel::raw(new ExcelExport($this, $data), 'Xlsx');
        }

        if(in_array(2, $this->type)) {
            $user = $data;
            $html     = View::make('exports.reports', ['users' => $user, 'column' => $this->column ])->render();

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



        }


        if(in_array(1, $this->type) && !in_array(2, $this->type))
        {
            return response()->streamDownload(function () use ($excel) {
                echo $excel;
            }, 'export.xlsx');
        }
        elseif (in_array(2, $this->type) && !in_array(1, $this->type))
        {
            return response()->streamDownload(function () use ($output){
                echo $output;
            }, 'export.pdf');
        }
        else
        {
            $zip = new \ZipArchive;
            \File::delete(public_path('export.zip'));
            if ($zip->open(public_path('export.zip'),  \ZipArchive::CREATE) === TRUE) {
                if(in_array(1, $this->type)) {
                    $zip->addFromString('export.xlsx',$excel);
                }
                if(in_array(2, $this->type)) {
                    $zip->addFromString('export.pdf',$output);
                }
                $zip->close();
            }

            return response()->download(public_path('export.zip'));
        }







    }
}
