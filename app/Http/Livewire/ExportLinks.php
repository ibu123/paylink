<?php

namespace App\Http\Livewire;

use ArPHP\I18N\Arabic;
use App\Models\Paylink;
use Livewire\Component;
use App\Exports\LinkExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\TemporaryDirectory\TemporaryDirectory;

class ExportLinks extends Component
{

    public $payLinkId;
    public $payLinkStatus;
    public $date_range;
    public $type = [];

    protected $rules = [
        'payLinkId' => 'nullable|regex:/^[0-9,]+$/',
        'type' => 'required'
    ];

    public function messages()
    {
        return [
            'payLinkId.*' => __('The PayLink Id field only contains digits and comma(,) with no sapce'),
            'type.*' => __('Please select at least one option')
        ];
    }
    public function render()
    {
        return view('livewire.export-links');
    }

    public function export()
    {

        $this->validate();
        $temp = explode(" - ",$this->date_range);
        if(!empty($temp)) {
            $fromDate = $temp[0];
            $toDate = $temp[1];
        }
        // $temporaryDirectory = (new TemporaryDirectory())->create();
        // $rows = $this->rows;
        $payLinks = Paylink::with('store')
        ->select('*')
        ->addSelect(\DB::raw('TIMESTAMPDIFF(SECOND, UNIX_TIMESTAMP() , expiration_date ) AS expired'))
        ->when(!empty($this->payLinkId), function($q){
            $q->whereIn('id', explode("," , $this->payLinkId));
        })->when(!empty($this->payLinkStatus) , function($q) {
            $q->whereIn('payment_status', $this->payLinkStatus);
        })->when(!empty($this->payLinkStatus) && in_array(4, $this->payLinkStatus), function($q){
            $q->orWhere(function($q) {
                $q->where([
                    'payment_status' => 2,
                    'send_payment_status' => 2
                ]);
            });
        })
        ->when(!empty($temp), function($q) use ($temp, $fromDate, $toDate){
            $q->where('paid_date', '>=', Carbon::parse($fromDate))
            ->where('paid_date', '<=', Carbon::parse($toDate));
        })
        ->get();

        if($payLinks->isEmpty()) {
            return $this->addError('no-filter-match', __('No Filter Match'));

        }
        if(in_array(1, $this->type)) {
            $excel = Excel::raw(new LinkExport($this, $payLinks), 'Xlsx');
        }

        if(in_array(2, $this->type) || in_array(3, $this->type) ) {
            $html = '';
            $merchantHtml = '';
            foreach($payLinks as $paylink) {
                if(in_array(2, $this->type)) {
                    $qrcode = base64_encode(QrCode::format('svg')->size(200)->generate(
                        route('invoice', $paylink->order_id)
                    ));
                    $html .= View::make('exports.link-invoice', compact('qrcode', 'paylink'))->render();
                }

                if(in_array(3, $this->type)) {
                    $qrcode = base64_encode(QrCode::format('svg')->size(200)->generate(
                        route('seller.invoice', $paylink->order_id)
                    ));
                    $merchantHtml .= View::make('exports.merchant-invoice', compact('qrcode', 'paylink'))->render();
                }
            }

            if(!empty($html)) {
                $arabic = new Arabic();
                $p = $arabic->arIdentify($html);
                for ($i = count($p)-1; $i >= 0; $i-=2) {
                    $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
                    $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
                }

                $pdf = Pdf::setOption([
                    'enable_php' => true,
                ])->setPaper('a4')->loadHtml($html);
                $output = $pdf->output();
            }

            if(!empty($merchantHtml)) {
                $merchantArabic = new Arabic();
                $p = $merchantArabic->arIdentify($merchantHtml, true);
                for ($i = count($p)-1; $i >= 0; $i-=2) {
                    $utf8ar = $merchantArabic->utf8Glyphs(substr($merchantHtml, $p[$i-1], $p[$i] - $p[$i-1]));
                    $merchantHtml = substr_replace($merchantHtml, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
                }

                $merchantPDF = Pdf::setOption([
                    'enable_php' => true,
                ])->setPaper('a4')->loadHtml($html);
                $merchantOutput = $pdf->output();
            }
        }

        if(in_array(1, $this->type) && !in_array(2, $this->type) && !in_array(3, $this->type)) {
            return response()->streamDownload(function () use ($excel){
                echo $excel;
            }, 'links-excel-sheet.xlsx');
        }
        elseif(in_array(2, $this->type) && !in_array(1, $this->type) && !in_array(3, $this->type)) {
            return response()->streamDownload(function () use ($output){
                echo $output;
            }, 'link-invoices.pdf');
        }
        elseif(in_array(3, $this->type) && !in_array(2, $this->type) && !in_array(1, $this->type)) {
            return response()->streamDownload(function () use ($merchantOutput){
                echo $merchantOutput;
            }, 'platform-invoices.pdf');
        }
        else {
            $zip = new \ZipArchive;
            \File::delete(public_path('merchant-export.zip'));
            if ($zip->open(public_path('merchant-export.zip'),  \ZipArchive::CREATE) === TRUE) {
                if(in_array(1, $this->type)) {
                    $zip->addFromString('links-excel-sheet.xlsx',$excel);
                }
                if(in_array(2, $this->type)) {
                    $zip->addFromString('link-invoices.pdf',$output);
                }
                if(in_array(3, $this->type)) {
                    $zip->addFromString('platform-invoices.pdf',$merchantOutput);
                }
                $zip->close();
            }

            return response()->download(public_path('merchant-export.zip'));
        }
    }

    public function resetProp()
    {
        $this->resetValidation();
        $this->reset();
    }
}
