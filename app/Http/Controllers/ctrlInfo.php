<?php

namespace App\Http\Controllers;

use App\Categorias;
use App\ObtenerProductos;
use Illuminate\Http\Request;

class ctrlInfo extends Controller
{
    public function verInfo($productoid){
        return view('infoProducto',
            ['categorias' => Categorias::all()],
            ['producto' =>ObtenerProductos::where('producto_id',$productoid)->get()]
        );
    }
}
