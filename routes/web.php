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
Route::get('/cuenta/{id_usuario}','ctrlMenu@verCuenta')->name('datosCuenta');
Route::get('/cuentaModificar/{id_usuario}','ctrlMenu@verCuentaModificar')->name('datosCuentaModificar');
Route::get('/cuentaCambiarPass/{id_usuario}','ctrlMenu@verCuentaCambiarPass')->name('datosCuentaCambiarPass');
Route::get('/cuentaEliminar/{id_usuario}','ctrlMenu@verCuentaEliminar')->name('datosCuentaEliminar');
Route::post('/modificar','ctrlUsuario@modificar')->name('modificarDatos');
Route::post('/modificarPass','ctrlUsuario@cambiarPass')->name('modificarPass');
Route::post('/eliminar','ctrlUsuario@eliminar')->name('eliminarUsuario');
Route::get('/pedidos/{id_usuario}','ctrlMenu@verPedidos')->name('datosPedidos');
Route::post('/cancelarpedido','ctrlMenu@cancelarPedido')->name('cancelarPedido');
Route::post('/cancelaritem','ctrlMenu@cancelarItem')->name('cancelarItem');

//Rutas Enviar Correo
Route::post('/correoCustom','ctrlCorreo@correoCustom')->name('correoCustom');
Route::get('/correoPrueba','ctrlCorreo@correoPrueba')->name('correoPrueba');

//Rutas Comprar
Route::get('/comprobarCompra','ctrlComprar@comprar')->name('comprobarCompra');
Route::get('/comprar','ctrlComprar@realizarCompra')->name('comprar');

//Rutas PDF
Route::get('/pdfPrueba','ctrlPDF@pdfPrueba')->name('pdfPrueba');
Route::get('/descargarPDF/{facturaid}','ctrlPDF@descargarPDF')->name('descargarPDF');




