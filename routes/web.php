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

Route::get('/', function () {
    return view('plantilla');
});
/*
Route::view('/', 'paginas.inicio');
Route::view('/avisos', 'paginas.aviso');
Route::view('/noticias', 'paginas.noticia');
Route::view('/inicio', 'paginas.inicio');

Route::get('/avisos', 'AvisosController@traerAviso');
Route::get('/noticias', 'NoticiasController@traerNoticia');
*/

Route::resource('/', 'AvisosController');
/*Route::resource('/noticias', 'NoticiasController');*/
Route::resource('/avisos', 'AvisosController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
