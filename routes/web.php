<?php

use App\Http\Livewire\ShowPosts;
use App\Http\Livewire\AddMerchant;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return view('admin.login');
});


Route::get('dashboard', function () {
    return view('admin.dashboard');
});

Route::get('merchant-list', [AddMerchant::class, 'list'])->name('list');
