<?php

use Illuminate\Support\Facades\Route;

Route::get('/xyzpayments/{user}', 'FormsController@xyzpayment');
Route::get('/oldpay/{user}', 'FormsController@oldpay');

Route::post('payment/xyz/{id}', 'XYZpaymentsController@send');
Route::post('payment/old/{id}', 'OLDpayController@send');

Route::get('payment/xyzaccept', 'XYZpaymentsController@process');
Route::post('payment/oldaccept', 'OLDpayController@process');
