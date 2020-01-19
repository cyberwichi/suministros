<?php

use App\Http\Controllers\ClientController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clientes/', 'ClientController@index')->name('indexclient');
Route::post('cliente/', 'ClientController@new')->name('newclient');
Route::post('cliente/{id}', 'ClientController@update')->name('updateclient');
Route::delete('cliente/{id}', 'ClientController@delete')->name('deleteclient');
Route::get('searchcontacto/{dd}', 'ClientController@searchcontacto')->name('searchcontacto');

Route::get('contrato/', 'ContratoController@index')->name('indexcontrato');
Route::post('contrato/', 'ContratoController@store')->name('nuevocontrato');
Route::delete('contrato/{id}', 'ContratoController@destroy')->name('borracontrato');
Route::put('contrato/{id}', 'ContratoController@update')->name('updatecontrato');

