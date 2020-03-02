<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;
use App\Facturas;
use App\ObtenerProductos;
use App\Items;
use App\Http\Controllers\ctrlCorreo;
use App\Http\Controllers\ctrlPDF;
use Cart;
use Darryldecode\Cart\Cart as CartCart;

class ctrlComprar extends Controller
{
    public function comprobar()
    {
        $carro = Cart::getContent()->toArray();
        $ok = 0;
        $productos = 0;
        foreach ($carro as $producto) {
            $productos++;
            if ($producto['attributes']['stock'] >= $producto['quantity']) {
                $ok++;
            }
        }
        if ($ok == $productos && session()->has('user')) {
            return true;
        } else {
            return false;
        }
    }

    public function comprar()
    {
        if ($this->comprobar()) {
            $carrito = Cart::getContent();
            return view('cuerpoCompra', compact('carrito'), ['categorias' => Categorias::all()]);
        } else {
            return back()->with('error', 'Error');
        }
    }

    public function realizarCompra()
    {
        if ($this->comprobar()) {
            if (!empty(session('tarjeta'))) {

                //Create Añadir factura
                Facturas::create([
                    'estado' => 'En preparación',
                    'nombre' => session('nombre'),
                    'apellidos' => session('apellidos'),
                    'dni' => session('dni'),
                    'domicilio' => session('domicilio'),
                    'correo' => session('correo'),
                    'tarjeta' => session('tarjeta'),
                    'fechapedido' => date('Y-m-d'),
                    'usuario_id' => session('usuarioid')
                ]);
                //

                //Update Bajar Stock
                $productos = Cart::getContent()->toArray();
                foreach ($productos as $producto) {
                    $stockFinal =  $producto['attributes']['stock'] - $producto['quantity'];
                    ObtenerProductos::where('producto_id', $producto['id'])->update(['stock' => $stockFinal]);

                //     //Create Añadir items de la factura
                    $facturaid = Facturas::orderBy('factura_id','desc')->first();
                    Items::create([
                        'precio' => $producto['price']*$producto['quantity'],
                        'cantidad' => $producto['quantity'],
                        'factura_id' => $facturaid->factura_id,
                        'producto_id' => $producto['id']
                    ]);
                //     //
                }
                //
                //Enviar el correo adjuntando el pdf
                $body = '
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        </head>
                        <body>
                        <div style="background-color:grey;">
                            <div style="background-color:white;">
                                <h5>Confirmacion de pedido</h5>
                                <p>Hola '.session('nombre').' '.session('apellidos').',</p>
                                <p>¡Muchas gracias por realizar el pedido numero '.$facturaid->factura_id.' en nuestra web!.</p>
                                <p>A continuacion te facilitamos la fecha aproximada de entrega de los pedidos.</p>
                                <p>Recibiras otro email cuando tu pedido este listo para ser enviado.</p>
                            </div>
                        </div>
                        </body>
                        ';

                ctrlPDF::crearPDF($facturaid->factura_id);
                ctrlCorreo::enviar(session('correo'),'Confirmación de pedido',$body,$facturaid->factura_id);
                //

                // Limpiar toda la sesion del CARRITO y no del login de usuario
                foreach($productos as $producto){
                    Cart::remove($producto['id']);
                }
                return redirect()->route('inicio')->with('success','¡Se ha realizado la compra correctamente, enseguida recibirás un correo con los datos de tu pedido!');
                // //
            } else {
                return back()->with('fail', 'Necesitas tener registrada una tarjeta');
            }
        } else {
            return back()->with('fail', 'No existe suficiente stock');
        }
    }
}
