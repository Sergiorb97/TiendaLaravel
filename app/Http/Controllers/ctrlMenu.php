<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\ObtenerProductos;
use App\Usuarios;
use App\Facturas;
use App\Items;
use Illuminate\Support\Facades\DB;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ctrlMenu extends Controller
{
    
    public function obtenerCategorias(){
        return ['categorias' => Categorias::all()];
    }
    
    public function obtenerDestacados(){
        return ['destacados' => ObtenerProductos::where('destacado','s') -> get()];
        //DB::table('productos')->where('destacado','s')->get();
    }

    public function obtenerProductos(){
        $TodosProductos = ObtenerProductos::query()->paginate(4);
        return ['productos' => $TodosProductos, 'destacados' => ObtenerProductos::where('destacado','s')->get()];
    }
    
    public function mostrarPortada(){
        //return view('inicio',['categorias' => Categorias::where('categoria_id','1') -> get()]);
        //return view('portada',['categorias' => Categorias::all()]);
        
        return view('cuerpoDestacados',
            $this -> obtenerCategorias(),
            $this -> obtenerProductos());
    }

    public function verCuenta($id_usuario){
        return view('cuerpoCuenta',
            $this -> obtenerCategorias(),
            ['usuario' => Usuarios::where(session('usuarioid'))->get()]);
    }

    public function verCuentaModificar($id_usuario){
        return view('cuerpoCuentaModificar',
            $this -> obtenerCategorias(),
            ['usuario' => Usuarios::where(session('usuarioid'))->get()]);
    }

    public function verCuentaEliminar($id_usuario){
        return view('cuerpoCuentaEliminar',
            $this -> obtenerCategorias(),
            ['usuario' => Usuarios::where(session('usuarioid'))->get()]);
    }
    
    public function verCuentaCambiarPass($id_usuario){
        return view('cuerpoCuentaCambiarPass',
            $this -> obtenerCategorias(),
            ['usuario' => Usuarios::where(session('usuarioid'))->get()]);
    }

    public function verPedidos($id_usuario){
        $facturas = DB::table('facturas')->join('items', 'facturas.factura_id', '=', 'items.factura_id')->join('productos','items.producto_id','=','productos.producto_id')->where('usuario_id', $id_usuario)->get();
        return view('cuerpoPedidos',
            $this -> obtenerCategorias(),
            ['facturas' => $facturas]);
    }

    public function cancelarPedido(Request $request){
        Facturas::where('factura_id',$request->get('facturaid'))->delete();
        return back()->with('success','¡Se ha cancelado el pedido!');
    }

    public function cancelarItem(Request $request){
        Items::where('item_id',$request->get('itemid'))->delete();
        return back()->with('success','¡Se ha cancelado un artículo!');
    }

    public function cerrarSesion(){
        session()->flush();
        return redirect()->route('inicio');
    }
}
