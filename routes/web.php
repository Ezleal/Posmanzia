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
    return view('home');
})->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* RUTAS DE USUARIOS */
Route::resource('/usuarios', 'UsersController');
Route::post('usuarios/update', 'UsersController@update')->name('usuarios.update');
Route::get('usuarios/destroy/{id}', 'UsersController@destroy');
Route::post('usuarios/{id}/edit', 'UsersController@edit')->name('usuarios.edit');
/* ------ FIN DE USUARIOS ----- */

/* RUTAS DE CATEGORIAS */
Route::resource('/categorias', 'CategoriasController');
Route::post('categorias/update', 'CategoriasController@update')->name('categorias.update');
Route::get('categorias/destroy/{id}', 'CategoriasController@destroy');
Route::post('categorias/{id}/edit', 'CategoriasController@edit')->name('categorias.edit');
/* ------ FIN DE CATEGORIAS ----- */

/* RUTAS DE PRODUCTOS */
/* ------ FIN DE PRODUCTOS ----- */

Auth::routes(["register" => false]);


Route::get('/home', 'HomeController@index')->name('home');
