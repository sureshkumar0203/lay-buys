<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//FOR STL TESTING
Route::post('notify-paypal-stl', 'paymentTestingController@updateTransactionDetails');
//FOR STL TESTING



Route::post('dp-notify-paypal', 'homeController@updateDownPaymentTransactionDetails');

Route::post('installment-notify-paypal', 'homeController@updateInstallmentTransactionDetails');

Route::post('rm-notify-paypal', 'adminController@updateReturnMoneyTransactionDetails');
