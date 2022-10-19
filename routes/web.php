<?php


use App\Http\Livewire\AddMerchant;
use App\Http\Livewire\ExportMerchant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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

Route::get('/', function () {
    return view('admin.login');
})->name('login')->middleware('guest');

Route::get('/login', function () {
    return view('admin.otp');
})->name('login');

Route::post('send-otp', [ AuthController::class, 'sendOTP'])->name('send-otp');
Route::post('verify-top', [ AuthController::class, 'verifyOTP'])->name('verify-otp');

// Route::group(['middleware' => 'auth'] , function(){

    Route::prefix('admin')
    // ->middleware('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('merchant-list', [AddMerchant::class, 'list'])->name('list');
        Route::any('export', [ExportMerchant::class, 'export'])->name('export');
    });

// });

