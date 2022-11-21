<?php

namespace App\Http\Controllers;

use ArPHP\I18N\Arabic;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class NoonPaymentController extends Controller
{
    public function createOrder()
    {
           //Key_Test bXVuYXQuRGFmYWg6MzhlZmFmMjZkOWE1NDlmYjkxNmY2ZWVmOGExZDNhOWU=
        $key = "Key_Test ".base64_encode("munat.oun:3ca4d2bfd1bb431d9a355e8f74dfc54d");

        $postJson = [
            "apiOperation" => "INITIATE",
            "order" => [
                "reference" => "1",
                "amount" => "55",
                "currency" => "SAR",
                "name" => "Sample order",
                "channel" => "web",
                "category" => "pay",

            ],
            "configuration" => [
                "locale" => "ar",
                "paymentAction" => "SALE",
                "returnUrl" => route('noon.captureOrder')
            ],
            "merchantDescriptor" => [
                "name" => "zaid",
                "legalName" => 'Asasd'
            ]
        ];
        $response = Http::
        withHeaders([
            "Content-type" => "application/json",
            "Authorization" => $key
        ])->post('https://api-stg.noonpayments.com/payment/v1/order', $postJson);

        $response = $response->object();
        dd($response);
        if ($response->resultCode == 0) {
            return redirect($response->result->checkoutData->postUrl);
        }
    }


}
