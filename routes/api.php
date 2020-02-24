<?php

use App\Article;
use App\Http\Controllers\ClientController;
use App\Proveedorarticle;
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
Route::get('cliente/{id}/contratos', 'ContratoController@show')->name('contratosporcliente');
Route::get('contrato/{id}', 'ContratoController@index2')->name('contratoporid');
Route::get('movimientos/{id}', 'ContratoController@movimientos')->name('movimientosporcontrato');



Route::get('articles/', 'ArticleController@index')->name('indexarticles');
Route::get('articlesapedir/', 'ArticleController@apedir')->name('apedirarticles');
Route::delete('article/{id}', 'ArticleController@delete')->name('deletearticle');
Route::put('article/{id}', 'ArticleController@update')->name('updatearticle');
Route::post('article/', 'ArticleController@new')->name('newarticle');
Route::get('searcharticulo/{dd}', 'ArticleController@searcharticulo')->name('searcharticulo');

Route::get('proveedores/', 'ProveedorController@index')->name('indexproveedores');
Route::post('proveedor/', 'ProveedorController@new')->name('newproveedores');
Route::put('proveedor/{id}', 'ProveedorController@update')->name('updateproveedores');
Route::delete('proveedor/{id}', 'ProveedorController@delete')->name('deleteproveedores');
Route::get('searchproveedor/{dd}', 'ProveedorController@searchproveedor')->name('searchproveedor');
Route::get('proveedor/{id}', 'ProveedorController@porid')->name('poridproveedor');

Route::post('proveedorarticulo/{id}/', 'ProveedorarticleController@new')->name('proveedorarticle');
Route::get('proveedorarticulo/{id}', 'ProveedorarticleController@porarticulo')->name('porarticuloproveedores');
Route::put('proveedorarticuloup/{id}', 'ProveedorarticleController@update')->name('updatearticuloproveedor');
Route::get('proveedor/{prov}/articulo/{id}', 'ProveedorarticleController@proveedorarticulo')->name('porarticuloyproveedor');

Route::post('aviso/', 'AvisoController@store')->name('newaviso');
Route::post('detalleaviso/', 'DetalleAvisoController@store')->name('newdetalleaviso');
Route::get('avisos/', 'AvisoController@index')->name('indexavisos');
Route::get('aviso/{id}', 'AvisoController@show')->name('showaviso');
Route::put('aviso/{id}', 'AvisoController@update')->name('updateaviso');
Route::delete('aviso/{id}', 'AvisoController@destroy')->name('deleteaviso');

Route::post('albaran/', 'AlbaranController@store')->name('newalbaran');
Route::get('albaranes/', 'AlbaranController@index')->name('indexalbaran');
Route::get('creapdf/{id}', 'AlbaranController@creapdf')->name('creapdfalbaran');

Route::post('pedido/', 'PedidoController@store')->name('newpedido');
Route::get('pedidos/', 'PedidoController@index')->name('indexpedido');
Route::delete('pedido/{id}', 'PedidoController@destroy')->name('deleteaviso');
Route::get('recibepedido/{id}', 'PedidoController@recibe')->name('recibepedido');
