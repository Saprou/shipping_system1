<?php
Route::group(['prefix' => 'dashboard/service/', 'middleware' => ['service']],function(){
    Route::post('/get-items', 'App\Http\Controllers\CustomerServiceController@getItems');
    Route::post('/set-deliver-ready','App\Http\Controllers\CustomerServiceController@setDeliverReady');
    Route::post('/set-return-ready','App\Http\Controllers\CustomerServiceController@setReturnReady');
    Route::post('/set-pickup-ready','App\Http\Controllers\CustomerServiceController@setPickupReady');
    Route::post('/set-ticket-open','App\Http\Controllers\CustomerServiceController@setTicketOpen');
    Route::post('/set-ticket-closed','App\Http\Controllers\CustomerServiceController@setTicketClosed');
    Route::post('/add-desc','App\Http\Controllers\CustomerServiceController@addDesc');
    Route::post('/find-item-trips', 'App\Http\Controllers\CustomerServiceController@itemTrips');
    Route::post('/find-courier-trips', 'App\Http\Controllers\CustomerServiceController@courierTrips');
});