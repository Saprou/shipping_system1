<?php
Route::group(['prefix' => 'dashboard/accountant/', 'middleware' => ['accountant']],function(){
    Route::post('/get-seller', 'App\Http\Controllers\AccountantController@getSeller');
    Route::post('/get-data', 'App\Http\Controllers\AccountantController@getData');
    Route::post('/set-trip-cash', 'App\Http\Controllers\AccountantController@setTripCash');
    Route::post('/collect-orders', 'App\Http\Controllers\AccountantController@collectOrders');
    Route::post('/pay-orders', 'App\Http\Controllers\AccountantController@payOrders');
    Route::post('/pay-trips', 'App\Http\Controllers\AccountantController@payTrips');
    Route::post('/find-item-trips', 'App\Http\Controllers\AccountantController@itemTrips');
    Route::post('/find-courier-trips', 'App\Http\Controllers\AccountantController@courierTrips');
});
Route::group(['prefix' => 'dashboard/accountant/', 'middleware' => ['accountant','service']],function(){
});

Route::post('/dashboard/accountant/add-order-to-pickup', 'App\Http\Controllers\AccountantController@addOrderToPickup');