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

// A classe Auth possui um método chamado routes, e aqui acesso esse método.
Auth::routes();

// o name declarado no final é tipo um alias que dou para aquela rota toda
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produtos/cadastrar', 'ProductController@viewFormProduct');

Route::post('/produtos/cadastrar', 'ProductController@create');