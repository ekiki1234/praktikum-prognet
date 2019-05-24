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

// Route::get('/', function () {
//     return view('userHome');
// });

Auth::routes();
    
Auth::routes(['verify' => true]);

Route::resource('/', 'BerandaController');
Route::get('show/{id}', 'BerandaController@show');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/addToCart/destroy', 'CartController@destroy');
Route::get('/shopping-cart/update/{id}', 'CartController@update');
Route::get('/shopping-cart/kurangi/{id}', 'CartController@kurangi');
Route::get('/shopping-cart/checkout', 'CartController@checkout');
Route::post('/addToCarts','CartController@addToCarts')->name('addToCart');


Route::group(['prefix' => 'admin'], function() {
    Route::get('/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.home');
    
    
});

Route::group(['middleware'=>'auth:admin'], function(){

    Route::resource('/barang', 'BarangController');
    Route::get('/keluar', 'AdminController@logout');
    Route::get('/barang/delete/{id}', 'BarangController@destroy');

    Route::resource('/kategori', 'KategoriController');
    Route::get('/kategori/delete/{id}', 'KategoriController@destroy');

    Route::resource('/kurir', 'KurirController');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/addToCart/{id}', 'CartController@addToCart');
    
    Route::resource('/addToCart', 'CartController');
    Route::resource('/kategoriUser', 'CategoryUserController');

    
    
    
});