<?php

use App\Models\Elemento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorInicio;
use App\Http\Controllers\ControladorCalendario;
use App\Http\Controllers\ControladorCatalogo;
use App\Http\Controllers\ControladorCatalogoEmergente;
use App\Http\Controllers\ControladorCatalogoPersonalizado;
use App\Http\Controllers\ControladorLogIn;
use App\Http\Controllers\ControladorRegistro;

Route::get('/', [ControladorInicio::class, 'index']);

Route::get('/conocenos', [ControladorCalendario::class, 'index']);

Route::get('/buscarpedido', [ControladorCalendario::class, 'index']);
Route::post('/buscarpedido', [ControladorCalendario::class, 'index']);

/*INICIO DE SESIÓN */

Route::get('/perfil', [ControladorCalendario::class, 'index']);
Route::put('/perfil', [ControladorCalendario::class, 'index']);

/*Route::get('/iniciar-sesion', [ControladorCalendario::class, 'index']);*/
Route::get('/iniciar-sesion', function(){
    return view('iniciar-sesion');
});

Route::post('/iniciar-sesion', [ControladorLogIn::class, 'index'])->name('login.index');

Route::get('/direccion', function(){
    return view('direccion');
});

Route::post('/direccion', [ControladorCalendario::class, 'index']);

//REGISTRO DE USUARIO NUEVO
Route::get('/registrar', [ControladorRegistro::class, 'index'])->name('registrar.index');
Route::post('/registrar', [ControladorRegistro::class, 'registrar'])->name('registrar.registro');

Route::get('/contrasena', [ControladorRegistro::class, 'contrasena'])->name('registrar.contrasena');
Route::post('/contrasena', [ControladorRegistro::class, 'guardarContrasena'])->name('registrar.guardarContrasena');

Route::get('/direccion', [ControladorRegistro::class, 'mostrarDireccion'])->name('registrar.direccion');
Route::post('/direccion', [ControladorRegistro::class, 'guardarDireccion'])->name('registrar.guardarDireccion');

Route::get('/cerrar-sesion', [ControladorCalendario::class, 'index']);
Route::delete('/cerrar-sesion', [ControladorCalendario::class, 'index']);

Route::get('/recuperar-clave/{token}', [ControladorCalendario::class, 'index']);

/*

/*RUTAS DE POSTRES FIJOS */
/*PETICIÓN DE PRUEBA MEDIANTE API.PHP */
//Route::get('fijo/categorias', [ControladorCatalogo::class, 'obtenerCategorias']);

Route::get('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'mostrarCatalogo'])->name('catalogo.get');
Route::post('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'guardarSeleccionCatalogo'])->name('catalogo.post');

Route::get('fijo/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario'])->name('calendario.get');
Route::post('fijo/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'seleccionarFecha'])->name('calendario.post');

Route::get('fijo/detalles-pedido', [ControladorCatalogo::class, 'mostrarDetalles'])->name('fijo.detallesPedido.get');
Route::post('fijo/detalles-pedido', [ControladorCatalogo::class, 'seleccionarDetalles'])->name('fijo.detallesPedido.post');

Route::get('fijo/detalles-direccion', [ControladorCatalogo::class, 'mostrarDireccion'])->name('fijo.direccion.get');
Route::post('fijo/detalles-direccion', [ControladorCatalogo::class, 'guardarDireccion'])->name('fijo.direccion.post');

Route::get('fijo/ticket/{folio}', [ControladorCatalogo::class, 'mostrarTicket'])->name('fijo.ticket.get');


/*RUTAS DE POSTRES PERSONALIZADOS */


Route::get('/personalizado', [ControladorCatalogoPersonalizado::class, 'mostrarCatalogo'])->name('personalizado.catalogo.get');
Route::post('/personalizado', [ControladorCatalogoPersonalizado::class, 'seleccionarCatalogo'])->name('personalizado.catalogo.post');


Route::get('personalizado/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario'])->name('personalizado.calendario.get');
Route::post('personalizado/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'seleccionarFecha'])->name('personalizado.calendario.post');

Route::get('personalizado/detalles-pedido', [ControladorCatalogoPersonalizado::class, 'mostrarDetalles'])->name('personalizado.detallesPedido.get');
Route::post('personalizado/detalles-pedido', [ControladorCatalogoPersonalizado::class, 'seleccionarDetalles'])->name('personalizado.detallesPedido.post');

Route::get('personalizado/detalles-direccion', [ControladorCatalogoPersonalizado::class, 'mostrarDireccion'])->name('personalizado.direccion.get');
Route::post('personalizado/detalles-direccion', [ControladorCatalogoPersonalizado::class, 'guardarDireccion'])->name('personalizado.direccion.post');

Route::get('personalizado/ticket/{folio}', [ControladorCatalogoPersonalizado::class, 'mostrarTicket'])->name('personalizado.ticket.get');



/* RUTAS DE POSTRES EMERGENTES  */


Route::get('/emergentes', [ControladorCatalogoEmergente::class, 'mostrar']);

Route::get('emergentes/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario']);
Route::post('emergentes/seleccionar-fecha', [ControladorCatalogo::class, 'seleccionarFecha']);

Route::get('emergentes/detalles-pedido', [ControladorCatalogoEmergente::class, 'mostrarDetalles'])->name('emergente.pedido');
Route::post('emergentes/detalles-pedido', [ControladorCatalogoEmergente::class, 'seleccionarDetalles'])->name('pedido.guardar');

Route::get('emergentes/detalles-direccion', [ControladorCatalogo::class, 'mostrarDireccion'])->name('pedido.direccion');
Route::post('emergentes/detalles-direccion', [ControladorCatalogoEmergente::class, 'seleccionarDireccion'])->name('pedido.guardarDireccion');

Route::get('emergentes/ticket/', [ControladorCatalogo::class, 'mostrarTicket'])->name('pedido.resumen');

