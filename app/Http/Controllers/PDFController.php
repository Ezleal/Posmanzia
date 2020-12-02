<?php

namespace App\Http\Controllers;
use App\{Venta, User, Cliente, Producto};
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function ReportesPDF($id){
        $venta = Venta::find($id);
        //DECODIFICAMOS LA LISTA DE PRODUCTOS JSON DE LA BASE DE DATOS
        $productos = json_decode($venta['productos'], true);
        // CONCATENAMOS TEXTO PARA EL GUARDAR COMO...
        $cod = 'Factura Nro '.$venta->codigo;
        //CONTADOR DE FACTURA PDF
        $contador = 1;
        
        $pdf = \PDF::loadView('/reportes/prueba', compact('venta', 'productos','contador'));
        // return $pdf->download('prueba.pdf'); --PARA DESCARGAR DIRECTAMENTE
        return $pdf->stream($cod.'.pdf');
    }
}
