<?php

use App\Models\Elemento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorInicio;
use App\Http\Controllers\ControladorCalendario;
use App\Http\Controllers\ControladorCatalogo;

Route::get('/', [ControladorInicio::class, 'index']);
Route::get('/inicio', [ControladorInicio::class, 'index']);
Route::get('/calendario', [ControladorCalendario::class, 'index']);
Route::get('/conocenos', [ControladorCalendario::class, 'index']);

Route::get('/buscarpedido', [ControladorCalendario::class, 'index']);
Route::post('/buscarpedido', [ControladorCalendario::class, 'index']);

/*INICIO DE SESIÓN */

Route::get('/perfil', [ControladorCalendario::class, 'index']);
Route::put('/perfil', [ControladorCalendario::class, 'index']);

Route::get('/iniciar-sesion', [ControladorCalendario::class, 'index']);
Route::post('/iniciar-sesion', [ControladorCalendario::class, 'index']);

Route::get('/registrar', [ControladorCalendario::class, 'index']);
Route::post('/registrar', [ControladorCalendario::class, 'index']);

Route::get('/cerrar-sesion', [ControladorCalendario::class, 'index']);
Route::delete('/cerrar-sesion', [ControladorCalendario::class, 'index']);

Route::get('/recuperar-clave/{token}', [ControladorCalendario::class, 'index']);

/*RUTAS DE POSTRES FIJOS */

Route::get('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'mostrar']);
Route::post('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'mostrar']);

Route::get('fijo/seleccionar-fecha', [ControladorCatalogo::class, 'mostrar-calendario']);
Route::post('fijo/seleccionar-fecha', [ControladorCatalogo::class, 'seleccionar-fecha']);

Route::get('fijo/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('fijo/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('fijo/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('fijo/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('fijo/detalles-entrega', [ControladorCatalogo::class, 'mostrar-detalles-entrega']);
Route::post('fijo/detalles-entrega', [ControladorCatalogo::class, 'seleccionar-detalles-entrega']);

Route::get('fijo/ticket/{folio}', [ControladorCatalogo::class, 'mostrar-ticket']);


/*RUTAS DE POSTRES PERSONALIZADOS */

Route::get('/personalizados', [ControladorCatalogo::class, 'mostrar']);

Route::get('personalizado/seleccionar-fecha', [ControladorCatalogo::class, 'mostrar-calendario']);
Route::post('personalizado/seleccionar-fecha', [ControladorCatalogo::class, 'seleccionar-fecha']);

Route::get('personalizado/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('personalizado/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('personalizado/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('personalizado/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('personalizado/detalles-entrega', [ControladorCatalogo::class, 'mostrar-detalles-entrega']);
Route::post('personalizado/detalles-entrega', [ControladorCatalogo::class, 'seleccionar-detalles-entrega']);

Route::get('personalizado/ticket/{folio}', [ControladorCatalogo::class, 'mostrar-ticket']);


/*RUTAS DE POSTRES EMERGENTES */

Route::get('/emergentes', [ControladorCatalogo::class, 'mostrar']);

Route::get('emergentes/seleccionar-fecha', [ControladorCatalogo::class, 'mostrar-calendario']);
Route::post('emergentes/seleccionar-fecha', [ControladorCatalogo::class, 'seleccionar-fecha']);

Route::get('emergentes/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('emergentes/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('emergentes/detalles-pedido', [ControladorCatalogo::class, 'mostrar-detalles']);
Route::post('emergentes/detalles-pedido', [ControladorCatalogo::class, 'seleccionar-detalles']);

Route::get('emergentes/detalles-entrega', [ControladorCatalogo::class, 'mostrar-detalles-entrega']);
Route::post('emergentes/detalles-entrega', [ControladorCatalogo::class, 'seleccionar-detalles-entrega']);

Route::get('emergentes/ticket/{folio}', [ControladorCatalogo::class, 'mostrar-ticket']);




