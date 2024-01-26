<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// routes/web.php
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('/admin/listings', \App\Http\Controllers\ListingController::class);
});


Route::get('/listing', 'ListingController@methodName');

Route::get('admin/listing/{userId}/get', [ListingController::class, 'getListing']);


// Route::post('/login', [ListingController::class, 'login']);

Route::get('/generate-link', 'ListingController@showLinkGeneratorForm')->name('generate-link');
Route::post('/generate-link', 'ListingController@getlisting');

Route::get('/admin/listing/{userId}/get', [ListingController::class, 'getListing'])
    ->name('listings.get');

    