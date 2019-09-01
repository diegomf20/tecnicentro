<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login','LoginController@ingresar');
Route::post('nota','ReparacionController@nota');
Route::post('reparacion/{id}/diagnosticar','ReparacionController@diagnosticar');
Route::post('reparacion/{id}/aprobar','ReparacionController@aprobar');
Route::post('reparacion/{id}/reparar','ReparacionController@reparar');
Route::post('reparacion/{id}/cobrar','ReparacionController@cobrar');
Route::post('user/{id}/estado','UserController@estado');
Route::post('proveedor/{id}/estado','ProveedorController@estado');
Route::post('cliente/{id}/estado','ClienteController@estado');
Route::post('herramienta/{id}/estado','HerramientaController@estado');
Route::post('accesorio/{id}/estado','AccesorioController@estado');
Route::get('cliente/consulta', 'ClienteController@consulta');

Route::resource('reparacion', 'ReparacionController');
Route::resource('user', 'UserController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('cliente', 'ClienteController');
Route::resource('herramienta', 'HerramientaController');
Route::resource('accesorio', 'AccesorioController');
Route::resource('compra', 'CompraController');