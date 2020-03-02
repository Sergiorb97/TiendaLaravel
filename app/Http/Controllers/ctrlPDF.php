<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use Cart;

class ctrlPDF extends Controller
{
    public static function crearPDF($facturaid)
    {
        $articulosCarrito = Cart::getContent();
        $id = $facturaid;
        $pdf = PDF::loadView('facturaPDF', compact('articulosCarrito'), compact('id'))->setPaper('a4', 'landscape');
        $pdf->save(public_path('Assets/pdf/') . 'factura' . $id . '.pdf');
    }

    public static function descargarPDF($facturaid)
    {
        $file= public_path('Assets/pdf/') . 'factura' . $facturaid . '.pdf';

        $headers = array(
                  'Content-Type: application/pdf',
                );
    
        return response()->download($file, 'factura' . $facturaid . '.pdf', $headers);
        
        // $pdf = PDF::loadFile(); Esto da error de prohibicion de DomPDF al acceder a la carpeta de pdf en public
        // return $pdf->download('factura' . $facturaid . '.pdf');
    }

    public static function pdfPrueba()
    {
        $pdf = PDF::loadHTML('<h1>Test</h1>');
        return $pdf->dowload();
    }
}
