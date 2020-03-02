<?php

namespace App\Http\Controllers;

use App\ObtenerProductos;
use App\Categorias;
use Cart;
use Illuminate\Http\Request;

class ctrlCarrito extends Controller
{
    public function insertarProducto($id_producto)
    {
        $producto = ObtenerProductos::findOrFail($id_producto);
        //-> first

        if ($producto->stock > 0) {
            Cart::add(array(
                'id' => $id_producto,
                'name' => $producto->nombre,
                'quantity' => 1,
                'price' => $producto->precioventa,
                'attributes' => array(
                    'descripcion' => $producto->descripcion,
                    'imagen' => $producto->imagen,
                    'stock' => $producto->stock
                )
            ));
            return back()->with('añadido','Producto añadido correctamente');
        } else {
            return back()->with('error','Error al añadir el pedido, producto agotado');
        }


    }

    public function verCarrito()
    {
        $carrito = Cart::getContent();
        return view('cuerpoCarrito', compact('carrito'), ['categorias' => Categorias::all()]);
    }

    public function vaciarCarrito()
    {
        $carrito = Cart::clear();
        return view('cuerpoCarrito', compact('carrito'), ['categorias' => Categorias::all()]);
    }


    public function borrarProductoCarrito($id_producto)
    {
        $carrito = Cart::remove($id_producto);
        // return view('cuerpoCarrito',compact('carrito'),['categorias' => Categorias::all()]);
        return back();
    }

    public function modificarCantidadCarrito($id_producto, $cantidad)
    {
        $datosCarrito = Cart::getContent();
        $datosCarrito -> toArray();
        $stock = ObtenerProductos::findOrFail($id_producto);
        //dd($datosCarrito);

        if($datosCarrito[$id_producto]['quantity'] + $cantidad <= $stock->stock){
            $carrito = Cart::update($id_producto, array('quantity' => $cantidad));
            return back();
        }else{
            return back()->with('error','Cantidad de productos máxima alcanzada');
        }
    }
}
