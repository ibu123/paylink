<?php

namespace App\Http\Controllers;

use ArPHP\I18N\Arabic;
use App\Models\Paylink;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    public function generateLinkInvoice(Request $request, $orderId)
    {
        $paylink = Paylink::with('store')->where('order_id', $orderId)->firstOrFail();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->generate(\Request::url()));
        $html     = View::make('exports.link-invoice', compact('qrcode','paylink'))->render();

        $arabic = new Arabic();


        $p = $arabic->arIdentify($html);
        for ($i = count($p)-1; $i >= 0; $i-=2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
            $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
        }

        $pdf = Pdf::setOption([
            'enable_php' => true,
        ])->setPaper('a4')->loadHtml($html);

        if($request->download) {
            return $pdf->download();
        }
        return $pdf->stream();
    }

    public function generateSellerInvoice(Request $request,$orderId)
    {
        $paylink = Paylink::with('store')->where('order_id', $orderId)->firstOrFail();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->generate(\Request::url()));
        $html     = View::make('exports.merchant-invoice', compact('qrcode', 'paylink'))->render();
        try {
            $arabic = new Arabic();
            $p = $arabic->arIdentify($html);
            for ($i = count($p)-1; $i >= 0; $i-=2) {
                $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));

                $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
                // dump($utf8ar, $html);
            }
        } catch(\Exception $e) {
            dd($e);
        }

        $pdf = Pdf::setOption([
            'enable_php' => true,
        ])->setPaper('a4')->loadHtml($html);

        if($request->download) {

        }

        return $pdf->stream();
    }
}
