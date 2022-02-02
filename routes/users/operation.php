<?php
Route::group(['prefix' => 'dashboard/operation/', 'middleware' => ['operation']],function(){
    Route::post('/get-items', 'App\Http\Controllers\OperationController@getItems');
    Route::post('/send-courier', 'App\Http\Controllers\OperationController@sendCourier');
    Route::post('/arr-courier', 'App\Http\Controllers\OperationController@arrCourier');
    Route::post('/find-order', 'App\Http\Controllers\OperationController@findOrder');
    Route::post('/find-pickup', 'App\Http\Controllers\OperationController@findPickup');
    Route::post('/find-item-trips', 'App\Http\Controllers\OperationController@itemTrips');
    Route::post('/find-courier-trips', 'App\Http\Controllers\OperationController@courierTrips');
    
    Route::post('/create-ticket', 'App\Http\Controllers\TicketController@create_from_user');
});