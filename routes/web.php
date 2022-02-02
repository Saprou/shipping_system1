<?php

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
Route::get('/home', function () {return view('welcome');})->name('home');
Route::get('/', function () {return view('welcome');});
Route::get('/login', function () {return view('auth\login');});
Route::get('/register', function () {return view('auth\register');});
Route::post('/excel/export/store','App\Http\Controllers\ExcelController@store');
Route::get('/excel/export/download','App\Http\Controllers\ExcelController@download');/* middle ware that he is an accountant */
include 'users/user.php';
include 'users/seller.php';
include 'users/accountant.php';
include 'users/operation.php';
include 'users/service.php';
include 'users/admin.php';

Route::get('/email/verify', 'App\Http\Controllers\VerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\VerificationController@verify')->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', 'App\Http\Controllers\VerificationController@resend')->name('verification.resend');
Route::post('/create-outsider-ticket', 'App\Http\Controllers\TicketController@create_outsider');

Route::get('/dashboard',[App\Http\Controllers\RoutesController::class, 'index'])->where('any', '.*')->middleware('auth')->middleware('verified');
Route::get('/dashboard/{any}',[App\Http\Controllers\RoutesController::class, 'index'])->where('any', '.*')->middleware('auth')->middleware('verified');
Auth::routes();

Route::post('/signup','App\Http\Controllers\Auth\RegisterController@customSignup');
Route::post('/login','App\Http\Controllers\Auth\LoginController@login');

