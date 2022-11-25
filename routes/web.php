<?php


use App\Http\Livewire\ViewLinks;
use App\Http\Livewire\AddMerchant;
use App\Http\Livewire\ExportMerchant;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AdminSettelment;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\NoonPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('admin.login');
    })->name('home');

});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('send-otp', [ AuthController::class, 'sendOTP'])->name('send-otp');
Route::get('re-send-otp', [ AuthController::class, 'reSendOTP'])->name('re-send-otp');
Route::post('verify-top', [ AuthController::class, 'verifyOTP'])->name('verify-otp');

Route::get('create-order', [ NoonPaymentController::class, 'createOrder'])->name('noon.createOrder');
Route::post('capture-order', [NoonPaymentControlle::class, 'captureOrder'])->name('noon.captureOrder');
Route::group(['middleware' => 'auth'] , function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('admin')
    ->middleware('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('merchant-list', [AddMerchant::class, 'list'])->name('list');
        Route::any('export', [ExportMerchant::class, 'export'])->name('export');
        Route::get('merchant-list', [ AdminSettelment::class, 'merchantList'])->name('merchant.list');
        Route::get('paylinks-list', [ AdminSettelment::class, 'payLinkList'])->name('paylinks.list');
     });

    Route::prefix('merchant')
    ->middleware('merchant')
    ->name('merchant.')
    ->group(function () {
        Route::get('dashboard', function () {
            return view('merchant.dashboard');
        })->name('dashboard');
        Route::post('links-list', [ViewLinks::class, 'links'])->name('links');
    });

});
Route::get('invoice/{orderId}', [ InvoiceController::class, 'generateLinkInvoice'])->name('invoice');
Route::get('seller/invoice/{orderId?}', [ InvoiceController::class, 'generateSellerInvoice'])->name('seller.invoice');
Route::get('success/{orderId?}', [ ViewLinks::class, 'success'])->name('success');
Route::get('{store}/{orderId}', [ ViewLinks::class, 'checkout'])->name('checkout');
Route::get('capture', [ ViewLinks::class, 'capture'])->name('capture');



