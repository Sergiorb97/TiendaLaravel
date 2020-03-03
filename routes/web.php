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
Route::get('/','ctrlMenu@mostrarPortada')->name('inicio');

//Rutas Carrito
Route::get('/carrito/{id_producto}','ctrlCarrito@insertarProducto')->name('insertarCarrito');
Route::get('/carrito','ctrlCarrito@verCarrito')->name('verCarrito');
Route::get('/carritoVaciar','ctrlCarrito@vaciarCarrito')->name('vaciarCarrito');
Route::get('/carritoRemove/{id_producto}','ctrlCarrito@borrarProductoCarrito')->name('borrarProducto');
Route::get('/carritoCantidad/{id_producto}/{cantidad}','ctrlCarrito@modificarCantidadCarrito')->name('modificarCantidad');

//Rutas Categoria
Route::get('/categoria/{categoriaid}','ctrlCategoria@categoria')->name('opcCategoria');

//Rutas InfoProducto
Route::get('/info/{productoid}','ctrlInfo@verInfo')->name('opcInfo');

//Rutas Formularios
Route::post('/login','ctrlSesion@comprobarLogin')->name('login');
Route::post('/registro','ctrlSesion@comprobarRegistro')->name('registro');

//Ruta Cerrar Sesion
Route::get('/cerrar','ctrlMenu@cerrarSesion')->name('cerrarSesion');

//Ruta Olvidar Contraseña
Route::post('/olvidada','ctrlUsuario@contraOlvidada')->name('olvidada');
Route::get('/restablecerContra/{usuario_id}','ctrlUsuario@restablecer')->name('restablecerContra');

//Rutas Datos Cuenta/Pedidos
Route::get('/cuenta/{id_usuario}','ctrlMenu@verCuenta')->middleware('autenticado')->name('datosCuenta');
Route::get('/cuentaModificar/{id_usuario}','ctrlMenu@verCuentaModificar')->middleware('autenticado')->name('datosCuentaModificar');
Route::get('/cuentaCambiarPass/{id_usuario}','ctrlMenu@verCuentaCambiarPass')->middleware('autenticado')->name('datosCuentaCambiarPass');
Route::get('/cuentaEliminar/{id_usuario}','ctrlMenu@verCuentaEliminar')->middleware('autenticado')->name('datosCuentaEliminar');
Route::post('/modificar','ctrlUsuario@modificar')->middleware('autenticado')->name('modificarDatos');
Route::post('/modificarPass','ctrlUsuario@cambiarPass')->middleware('autenticado')->name('modificarPass');
Route::post('/eliminar','ctrlUsuario@eliminar')->middleware('autenticado')->name('eliminarUsuario');
Route::get('/pedidos/{id_usuario}','ctrlMenu@verPedidos')->middleware('autenticado')->name('datosPedidos');
Route::post('/cancelarpedido','ctrlMenu@cancelarPedido')->middleware('autenticado')->name('cancelarPedido');
Route::post('/cancelaritem','ctrlMenu@cancelarItem')->middleware('autenticado')->name('cancelarItem');

//Rutas Enviar Correo
Route::post('/correoCustom','ctrlCorreo@correoCustom')->name('correoCustom');
Route::get('/correoPrueba','ctrlCorreo@correoPrueba')->name('correoPrueba');

//Rutas Comprar
Route::get('/comprobarCompra','ctrlComprar@comprar')->middleware('autenticado')->name('comprobarCompra');
Route::get('/comprar','ctrlComprar@realizarCompra')->middleware('autenticado')->name('comprar');

//Rutas PDF
Route::get('/pdfPrueba','ctrlPDF@pdfPrueba')->name('pdfPrueba');
Route::get('/descargarPDF/{facturaid}','ctrlPDF@descargarPDF')->name('descargarPDF');




