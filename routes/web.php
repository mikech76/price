<?php

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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('home', function() {
    return redirect('price.app');
});

// прайсы
Route::resource('price', 'PriceController');
Route::get('price/{priceId}/delete', 'PriceController@destroy');

// продукты
Route::resource('price.product', 'ProductController');
Route::get('price/{priceId}/product/{productId}/delete', 'ProductController@destroy');

