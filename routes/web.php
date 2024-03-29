<?php

use Illuminate\Support\Facades\Route;
use App\Mail\CompraMailable;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', 'HomeController@index')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/* RUTAS DE USUARIOS */
Route::resource('/usuarios', 'UsersController')->middleware(['auth', 'notActive']);
Route::post('usuarios/update', 'UsersController@update')->name('usuarios.update')->middleware(['auth', 'notActive']);
Route::get('usuarios/destroy/{id}', 'UsersController@destroy')->middleware(['auth', 'notActive']);
Route::post('usuarios/{id}/edit', 'UsersController@edit')->name('usuarios.edit')->middleware(['auth', 'notActive']);
/* ------ FIN DE USUARIOS ----- */

/* RUTAS DE CATEGORIAS */
Route::resource('/categorias', 'CategoriasController')->middleware(['auth', 'notActive']);
Route::post('categorias/update', 'CategoriasController@update')->name('categorias.update');
Route::get('categorias/destroy/{id}', 'CategoriasController@destroy');
Route::post('categorias/{id}/edit', 'CategoriasController@edit')->name('categorias.edit');
/* ------ FIN DE CATEGORIAS ----- */

/* RUTAS DE PRODUCTOS */
Route::resource('/productos', 'ProductosController')->middleware(['auth', 'notActive']);
Route::post('productos/update', 'ProductosController@update')->name('productos.update');
Route::get('productos/destroy/{id}', 'ProductosController@destroy');
Route::post('productos/{id}/edit', 'ProductosController@edit')->name('productos.edit');
Route::get('/productosTraer', 'ProductosController@show');
Route::get('traerPorNombre/{id}', 'ProductosController@traerPorNombre');
/* ------ FIN DE PRODUCTOS ----- */

/* RUTAS DE CLIENTES */
Route::resource('/clientes', 'ClientesController')->middleware(['auth', 'notActive']);
Route::post('clientes/update', 'ClientesController@update')->name('clientes.update');
Route::get('clientes/destroy/{id}', 'ClientesController@destroy');
Route::post('clientes/{id}/edit', 'ClientesController@edit')->name('clientes.edit');

/* ------ FIN DE CLIENTES ----- */

/* RUTAS DE VENTAS */
Route::resource('/ventas', 'VentasController')->middleware(['auth', 'notActive']);
Route::post('ventas/update', 'VentasController@update')->name('ventas.update');
Route::get('ventas/destroy/{id}', 'VentasController@destroy');
Route::post('ventas/{id}/edit', 'VentasController@edit')->name('ventas.edit');
Route::get('/reportes', 'VentasController@reportes')->name('ventas.reportes')->middleware(['auth', 'notActive','isAdmin']);
Route::get('/reportes/{inicio}/{fin}', 'VentasController@reportesFechas')->name('ventas.reportesFecha')->middleware(['auth', 'notActive' ,'isAdmin']);
Route::get('/reportesExcel', 'VentasController@reportesExcel')->name('ventas.reportesExcel')->middleware(['auth', 'notActive','isAdmin']);
Route::get('/reportesExcel/{inicio}/{fin}', 'VentasController@fechasExcel')->name('ventas.fechasExcel')->middleware(['auth', 'notActive','isAdmin']);

/* ------ FIN DE VENTAS ----- */

/* RUTAS DE VENTAS */
// Route::post('/arqueos/store', 'ArqueoController@store')->middleware(['auth', 'notActive']);
Route::resource('/arqueo', 'ArqueoController')->middleware(['auth', 'notActive'])->middleware(['auth', 'notActive']);
Route::put('arqueo/{arqueo}', 'ArqueoController@update')->name('arqueo.update')->middleware(['auth', 'notActive']);

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

/* RUTAS DE REPORTES EN PDF */
Route::get('reporte/pdf/{id}', 'PDFController@ReportesPDF')->name('verReporte')->middleware(['auth', 'notActive']);
