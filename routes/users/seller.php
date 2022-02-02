<?php
Route::post('/dashboard/seller/get-items', 'App\Http\Controllers\SellerController@getItems');
Route::post('/dashboard/seller/create-location', 'App\Http\Controllers\SellerController@createLocation');
Route::post('/dashboard/seller/create-contact', 'App\Http\Controllers\SellerController@createContact');
Route::post('/dashboard/seller/create-ticket', 'App\Http\Controllers\TicketController@create_from_user');
Route::post('/dashboard/seller/create-pickup', 'App\Http\Controllers\PickupController@create');
Route::post('/dashboard/seller/find-order', 'App\Http\Controllers\PickupController@findOrder');
Route::post('/dashboard/seller/find-pickup', 'App\Http\Controllers\PickupController@findPickup');
Route::post('/dashboard/courier-orders', 'App\Http\Controllers\CourierController@courierOrders');
