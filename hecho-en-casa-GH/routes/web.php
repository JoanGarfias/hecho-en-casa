<?php

use App\Models\Elemento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControladorInicio;
use App\Http\Controllers\ControladorCalendario;
use App\Http\Controllers\ControladorCatalogo;
use App\Http\Controllers\ControladorCatalogoEmergente;
use App\Http\Controllers\ControladorCatalogoPersonalizado;
use App\Http\Controllers\ControladorRegistro;
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorBuscarPedido;
use App\Http\Middleware\ProtectorSesion;
use App\Http\Middleware\EnlazadorPedido;
use App\Http\Controllers\ControladorPerfil;

/* VISTAS PRINCIPALES */
Route::get('/', [ControladorInicio::class, 'index'])->name('inicio.get');
Route::get('/conocenos', [ControladorCalendario::class, 'index']);
Route::get('/buscarpedido', [ControladorBuscarPedido::class, 'ObtenerFolio'])->name('buscarpedido.get');
Route::post('/buscarpedido', [ControladorBuscarPedido::class, 'MostrarPedido'])->name('buscarpedido.post');
Route::get('/calendario', [ControladorCalendario::class, 'index'])->name('calendario.get');
//Route::get('/perfil', [ControladorPerfil::class, ''])->name('perfil.get');
//Route::post('/perfil', [ControladorPerfil::class, ''])->name('perfil.post');

/* PROCESO DE LOGIN */
Route::get('/login', [ControladorLogin::class, 'mostrarLogin'])->name('login.get');
Route::post('/login', [ControladorLogin::class, 'Logear'])->name('login.post');
Route::get('/cerrar-sesion', [ControladorLogin::class, 'logout'])->middleware(ProtectorSesion::class);

/* PROCESO DE REGISTRO */
Route::get('/registrar', [ControladorRegistro::class, 'index'])->name('registrar.get');
Route::post('/registrar', [ControladorRegistro::class, 'registrar'])->name('registrar.post');
Route::get('/contrasena', [ControladorRegistro::class, 'contrasena'])->name('registrar.contrasena.get');
Route::post('/contrasena', [ControladorRegistro::class, 'guardarContrasena'])->name('registrar.contrasena.post');
Route::get('/direccion', [ControladorRegistro::class, 'mostrarDireccion'])->name('registrar.direccion.get');
Route::post('/direccion', [ControladorRegistro::class, 'guardarDireccion'])->name('registrar.direccion.post');

/* PROCESOS PARA RECUPERACION */
Route::get('/cambiar-clave', [ControladorRegistro::class, 'mostrarCambio'])->name('cambiar-clave.get');
Route::post('/guardar-contrasena', [ControladorRegistro::class, 'actualizarContrasena'])->name('cambiar-clave.post');
Route::get('/recuperacion/{token?}', [ControladorRegistro::class, 'validarRecuperacion'])->name('recuperacion.get');

/* RUTAS DE POSTRES FIJOS */
Route::get('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'mostrarCatalogo'])->name('fijo.catalogo.get');

Route::middleware([ProtectorSesion::class, EnlazadorPedido::class])->group(function () {
    Route::post('fijo/catalogo/{categoria?}', [ControladorCatalogo::class, 'guardarSeleccionCatalogo'])->name('fijo.catalogo.post');
    Route::get('fijo/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario'])->name('fijo.calendario.get');
    Route::post('fijo/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'seleccionarFecha'])->name('fijo.calendario.post');

    Route::get('fijo/detalles-pedido', [ControladorCatalogo::class, 'mostrarDetalles'])->name('fijo.detallesPedido.get');
    Route::post('fijo/detalles-pedido', [ControladorCatalogo::class, 'seleccionarDetalles'])->name('fijo.detallesPedido.post');

    Route::get('fijo/detalles-direccion', [ControladorCatalogo::class, 'mostrarDireccion'])->name('fijo.direccion.get');
    Route::post('fijo/detalles-direccion', [ControladorCatalogo::class, 'guardarDireccion'])->name('fijo.direccion.post');

    Route::get('fijo/ticket/{folio}', [ControladorCatalogo::class, 'mostrarTicket'])->name('fijo.ticket.get');
});

/* RUTAS DE POSTRES PERSONALIZADOS */
Route::get('/personalizado', [ControladorCatalogoPersonalizado::class, 'mostrarCatalogo'])->name('personalizado.catalogo.get');

Route::middleware([ProtectorSesion::class, EnlazadorPedido::class])->group(function () {
    Route::post('/personalizado', [ControladorCatalogoPersonalizado::class, 'seleccionarCatalogo'])->name('personalizado.catalogo.post');

    Route::get('personalizado/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario'])->name('personalizado.calendario.get');
    Route::post('personalizado/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'seleccionarFecha'])->name('personalizado.calendario.post');

    Route::get('personalizado/detalles-pedido', [ControladorCatalogoPersonalizado::class, 'mostrarDetalles'])->name('personalizado.detallesPedido.get');
    Route::post('personalizado/detalles-pedido', [ControladorCatalogoPersonalizado::class, 'seleccionarDetalles'])->name('personalizado.detallesPedido.post');

    Route::get('personalizado/detalles-direccion', [ControladorCatalogoPersonalizado::class, 'mostrarDireccion'])->name('personalizado.direccion.get');
    Route::post('personalizado/detalles-direccion', [ControladorCatalogoPersonalizado::class, 'guardarDireccion'])->name('personalizado.direccion.post');

    Route::get('personalizado/ticket/{folio}', [ControladorCatalogoPersonalizado::class, 'mostrarTicket'])->name('personalizado.ticket.get');
});

/* RUTAS DE POSTRES EMERGENTES */
Route::get('/emergentes', [ControladorCatalogoEmergente::class, 'mostrar'])->name('emergente.catalogo.get');

Route::middleware([ProtectorSesion::class, EnlazadorPedido::class])->group(function () {
    Route::post('/emergentes', [ControladorCatalogoEmergente::class, 'guardarSeleccion'])->name('emergente.catalogo.post');

    Route::get('emergentes/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'mostrarCalendario'])->name('emergente.calendario.get');
    Route::post('emergentes/seleccionar-fecha/{mes?}/{anio?}', [ControladorCatalogo::class, 'seleccionarFecha'])->name('emergente.calendario.post');

    Route::get('emergentes/detalles-pedido', [ControladorCatalogoEmergente::class, 'mostrarDetalles'])->name('emergente.detallesPedido.get');
    Route::post('emergentes/detalles-pedido', [ControladorCatalogoEmergente::class, 'seleccionarDetalles'])->name('emergente.detallesPedido.post');

    Route::get('emergentes/detalles-direccion', [ControladorCatalogoEmergente::class, 'mostrarDireccion'])->name('emergente.direccion.get');
    Route::post('emergentes/detalles-direccion', [ControladorCatalogoEmergente::class, 'seleccionarDireccion'])->name('emergente.direccion.post');

    Route::get('emergentes/ticket/', [ControladorCatalogo::class, 'mostrarTicket'])->name('emergente.ticket.get');
});

