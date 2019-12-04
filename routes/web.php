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
// O Laravel cria as rotas /login e /register através desse método
Auth::routes();

// Criando rota para api google. Como o Login Controller não está na raiz da pasta controller, colocamos o caminho completo
Route::get('/login/google','Auth\LoginController@redirectToGoogle');

// E nessa rota que o Google vai devolver os dados do usuário dele
Route::get('/login/google/callback','Auth\LoginController@receiveDataGoogle');


// o name declarado no final é tipo um alias que dou para aquela rota toda
Route::get('/home', 'HomeController@index')->name('home');

// Em todas as rotas que devem passar pelo middleware CheckUser criado, coloco o middleware no final
Route::get('/produtos/cadastrar', 'ProductController@viewFormProduct')->middleware('checkuser');

Route::post('/produtos/cadastrar', 'ProductController@create');

// Rota parametrizada, o que está dentro das chaves é variável
// A rota só existe se um id for passado. Para deixar opcional, coloco um ?
Route::get('/produtos/atualizar/{id?}', 'ProductController@viewFormUpdate');

// Rota para quando o usuário atualizar o formulário de produto, dados enviados via post
Route::post('/produtos/atualizar', 'ProductController@update');

// Criando rota para usuário visualizar lista de produtos
Route::get('/produtos', 'ProductController@viewAllProducts');

// Criando rota para usuário deletar produto
Route::get('/produtos/deletar/{id?}', 'ProductController@deleteProduct');

