<?php

namespace App\Http\Controllers;
use App\{Venta, User, Cliente, Producto};
use Illuminate\Http\Request;

class PDFController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
     
    }
    public function ReportesPDF($id){
        $venta = Venta::find($id);
        //DECODIFICAMOS LA LISTA DE PRODUCTOS JSON DE LA BASE DE DATOS
        $productos = json_decode($venta['productos'], true);
        // CONCATENAMOS TEXTO PARA EL GUARDAR COMO...
        $cod = 'Factura_Nro_'.$venta->codigo;
        //CONTADOR DE FACTURA PDF
        $contador = 1;
        
        $pdf = \PDF::loadView('/reportes/reportePDF', compact('venta', 'productos','contador'));
        // return $pdf->download('Dprueba.pdf'); --PARA DESCARGAR DIRECTAMENTE
        return $pdf->stream($cod.'.pdf');
    }

       public function DownPDF($id)
       {
        $venta = Venta::find($id);
        //DECODIFICAMOS LA LISTA DE PRODUCTOS JSON DE LA BASE DE DATOS
        $productos = json_decode($venta['productos'], true);
        // CONCATENAMOS TEXTO PARA EL GUARDAR COMO...
        $cod = 'Factura_Nro_'.$venta->codigo;
        //CONTADOR DE FACTURA PDF
        $contador = 1;
        
        $pdf = \PDF::loadView('/reportes/reportePDF', compact('venta', 'productos','contador'));
        
        return $pdf->download($cod.'.pdf'); 
    }
}
