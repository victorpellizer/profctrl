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

Route::get('/home', 'HomeController@index')->name('home');


//-------------------- rotas referentes à RequisicoesController --------------------- //
// data tables
//Route::get('requisicoes/getdata', 'RequisicoesController@data_tables')->name('data_table_requisicoes');
//ressource
Route::resource('docente', 'DocenteController')->middleware('auth');
//------------------------------------------------------------------------------//
