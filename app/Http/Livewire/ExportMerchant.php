<?php

namespace App\Http\Livewire;

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

    public function render()
    {
        return view('livewire.export-merchant');
    }

    public function export()
    {

        // $temporaryDirectory = (new TemporaryDirectory())->create();
        // $rows = $this->rows;
        $data = Merchant::when(!empty($this->merchantId), function($q){
            $q->whereIn('id', explode($this->merchantId));
        })->when(!empty($this->date_range), function($q){
            $dates = explode(" - ", $this->date_range);
            $q->where('created_at', '>=', $dates[0]);
            $q->where('created_at', '<=', $dates[0]);
        })->get();

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
            return response()->streamDownload(function () use ($pdf){
                echo $pdf;
            }, 'export.pdf');
        }
        else
        {
            $zip = new \ZipArchive;
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
