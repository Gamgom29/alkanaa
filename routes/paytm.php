<?php

//Paytm

use App\Http\Controllers\Api\V2\KhaltiController;
use App\Http\Controllers\Api\V2\MyfatoorahController;
use App\Http\Controllers\Api\V2\PaytmController;
use App\Http\Controllers\Api\V2\PhonepeController;
use App\Http\Controllers\Payment\ToyyibpayController;

Route::controller(PaytmController::class)->group(function () {
    Route::get('/paytm/index', 'pay');
    Route::post('/paytm/callback', 'callback')->name('paytm.callback');
});

//Admin
if (method_exists(PaytmController::class, 'credentials_index') && method_exists(PaytmController::class, 'update_credentials')) {
    Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
        Route::controller(PaytmController::class)->group(function () {
            Route::get('/paytm_configuration', 'credentials_index')->name('paytm.index');
            Route::post('/paytm_configuration_update', 'update_credentials')->name('paytm.update_credentials');
        });
    });
}

//Toyyibpay
if (class_exists(ToyyibpayController::class)) {
    Route::controller(ToyyibpayController::class)->group(function () {
        Route::get('toyyibpay-status', 'paymentstatus')->name( 'toyyibpay-status');
        Route::post('/toyyibpay-callback', 'callback')->name( 'toyyibpay-callback');
    });
}

//Myfatoorah START
Route::get('/myfatoorah/callback', [MyfatoorahController::class,'callback'])->name('myfatoorah.callback');

//Khalti START
Route::any('/khalti/payment/done', [KhaltiController::class,'paymentDone'])->name('khalti.success');

// phonepe
Route::controller(PhonepeController::class)->group(function () {
    Route::any('/phonepe/pay', 'pay')->name('phonepe.pay');
    Route::any('/phonepe/redirecturl', 'phonepe_redirecturl')->name('phonepe.redirecturl');
    Route::any('/phonepe/callbackUrl', 'phonepe_callbackUrl')->name('phonepe.callbackUrl');
});
