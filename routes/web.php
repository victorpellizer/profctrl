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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contato', 'HomeController@contato')->middleware('auth');
Route::get('docente-list', 'DocenteController@docenteList')->name('docentelist');
Route::get('progressao-list', 'ProgressaoController@progressaoList')->name('progressaoList');
Route::get('titulo-list', 'TituloController@tituloList')->name('tituloList');
Route::get('docentes/create', 'DocenteController@create')->name('create'); 
Route::get('docentes/{id}/show', 'DocenteController@show')->name('show'); 

//-------------------- rotas referentes à RequisicoesController --------------------- //
// data tables
//Route::get('requisicoes/getdata', 'RequisicoesController@data_tables')->name('data_table_requisicoes');
//ressource
Route::resource('docentes', 'DocenteController')->middleware('auth');
Route::resource('regra', 'RegraController')->middleware('auth');
Route::resource('progressao', 'ProgressaoController')->middleware('auth');
Route::resource('titulos', 'TituloController')->middleware('auth');
Route::resource('licencas', 'LicencaController')->middleware('auth');
Route::resource('remuneracao', 'RemuneracaoController')->middleware('auth');
Route::resource('contatos', 'ContatoController')->middleware('auth');
Route::resource('classe', 'ClasseController')->middleware('auth');
Route::resource('nivel', 'NivelController')->middleware('auth');
Route::resource('lotacao', 'LotacaoController')->middleware('auth');
Route::resource('funcao', 'FuncaoController')->middleware('auth');
Route::resource('informacoes', 'InformacoesController')->middleware('auth');
Route::resource('eventos', 'EventoController')->middleware('auth');
/*
Route::resource('progressao', 'ProgressaoController')->middleware('auth');
Route::resource('progressao', 'ProgressaoController')->middleware('auth');

//------------------------------------------------------------------------------//
