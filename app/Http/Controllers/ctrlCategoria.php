<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\ObtenerProductos;
use Illuminate\Http\Request;

class ctrlCategoria extends Controller
{

    public function obtenerCategorias(){
        return ['categorias' => Categorias::all()];
    }

    public function productosCategoria($categoriaid){
        $productosCategoria = ObtenerProductos::where('categoria_id',$categoriaid);
        return ['paginarProductos' => $productosCategoria->paginate(4),'productosCategoria' => $productosCategoria->get()];
    }

    public function categoria($categoriaid){
        return view('cuerpoCategoria',
            $this->obtenerCategorias(),
            $this->productosCategoria($categoriaid));
    }
}
