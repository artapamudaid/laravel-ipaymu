<?php

use App\Http\Controllers\IpaymuController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('direct-payment', [IpaymuController::class, 'directPayment']);
Route::get('redirect-payment', [IpaymuController::class, 'redirectPayment']);
