<?php
Route::group(['middleware' => ['auth']],function(){
    Route::post('/dashboard/seller/create-deliver', 'App\Http\Controllers\OrderController@create_deliver');
    Route::post('/dashboard/seller/create-exchange', 'App\Http\Controllers\OrderController@create_exchange');
    Route::post('/dashboard/seller/create-return', 'App\Http\Controllers\OrderController@create_return');
    Route::post('/dashboard/find-order', 'App\Http\Controllers\OrderController@findOrder');
    Route::post('/dashboard/create-pickup', 'App\Http\Controllers\PickupController@create');
    Route::post('/dashboard/find-pickup', 'App\Http\Controllers\PickupController@findPickup');    
    Route::post('/dashboard/find-trip', 'App\Http\Controllers\TripController@itemTrips');
    Route::post('/dashboard/accountant/create-ticket','App\Http\Controllers\CustomerServiceController@createTicket');
    Route::post('/dashboard/user/update-password', 'App\Http\Controllers\UserController@updatePassword');
    Route::post('/dashboard/add-note-to-order', 'App\Http\Controllers\OrderController@addNote');
    Route::post('/dashboard/add-note-to-pickup', 'App\Http\Controllers\PickupController@addNote');
});