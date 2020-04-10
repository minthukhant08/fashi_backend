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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'brand'], function()
{
      Route::get('/delete/{id}', 'BrandController@destroy');
      Route::get('/', 'BrandController@index');
      Route::post('/', 'BrandController@store');
      Route::put('/{id}', 'BrandController@update');
});

Route::group(['prefix' => 'type'], function()
{
      Route::get('/delete/{id}', 'TypeController@destroy');
      Route::get('/', 'TypeController@index');
      Route::post('/', 'TypeController@store');
      Route::put('/{id}', 'TypeController@update');
});

Route::group(['prefix' => 'order'], function()
{
      Route::get('/delete/{id}', 'OrderController@destroy');
      Route::get('/', 'OrderController@index');
      Route::post('/', 'OrderController@store');
      Route::put('/{id}', 'OrderController@update');
      Route::get('/delivery', 'OrderController@delivery');
});


Route::group(['prefix' => 'supplier'], function()
{
      Route::get('/delete/{id}', 'SupplierController@destroy');
      Route::get('/', 'SupplierController@index');
      Route::post('/', 'SupplierController@store');
      Route::put('/{id}', 'SupplierController@update');
});

Route::group(['prefix' => 'category'], function()
{
      Route::get('/delete/{id}', 'CategoryController@destroy');
      Route::get('/', 'CategoryController@index');
      Route::post('/', 'CategoryController@store');
      Route::put('/{id}', 'CategoryController@update');
});

Route::group(['prefix' => 'promotion'], function()
{
      Route::get('/delete/{id}', 'PromotionController@destroy');
      Route::get('/', 'PromotionController@index');
      Route::post('/', 'PromotionController@store');
      Route::put('/{id}', 'PromotionController@update');
});

Route::group(['prefix' => 'product'], function()
{
      Route::get('/delete/{id}', 'ProductController@destroy');
      Route::get('/', 'ProductController@index');
      Route::get('/restock', 'ProductController@restocklist');
      Route::put('/restock', 'ProductController@restock');
      Route::post('/', 'ProductController@store');
      Route::get('/{id}', 'ProductController@find');
      Route::post('/{id}', 'ProductController@update');
});
