<?php
Route::group(['prefix' => 'dashboard/admin', 'middleware' => ['admin']],function(){
    Route::post('/get-items', 'App\Http\Controllers\AdminController@getItems');
    Route::post('/ban' , 'App\Http\Controllers\AdminController@ban');
    Route::post('/ban-courier' , 'App\Http\Controllers\AdminController@banCourier');
    Route::post('/active', 'App\Http\Controllers\AdminController@active');
    Route::post('/active-courier', 'App\Http\Controllers\AdminController@activeCourier');
    Route::post('/create-user', 'App\Http\Controllers\AdminController@createUser');
    Route::post('/create-courier', 'App\Http\Controllers\AdminController@createCourier');
    Route::post('/update-order-status', 'App\Http\Controllers\AdminController@updateOrderStatus');
    Route::post('/update-pickup-status', 'App\Http\Controllers\AdminController@updatePickupStatus');
    Route::post('/activate-seller', 'App\Http\Controllers\AdminController@activateSeller');
    Route::post('/ban-seller', 'App\Http\Controllers\AdminController@banSeller');
    Route::post('/find-seller', 'App\Http\Controllers\AdminController@findSeller');
    Route::post('/update-seller', 'App\Http\Controllers\AdminController@updateSeller');
    Route::post('/update-order', 'App\Http\Controllers\AdminController@updateOrder');
    Route::post('/update-courier', 'App\Http\Controllers\AdminController@updateCourier');
    Route::post('/find-actions', 'App\Http\Controllers\AdminController@findActions');
    Route::get('/gg', 'App\Http\Controllers\AdminController@gg');
});