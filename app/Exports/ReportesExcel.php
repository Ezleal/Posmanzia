<?php

namespace App\Exports;
use App\{Venta, User, Cliente, Producto};
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ReportesExcel implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($inicio, $fin)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
    }

    public function view(): View
    {
        if(!empty($this->inicio))
         {

        $ventas = Venta::whereBetween('fecha', array($this->inicio.'%', $this->fin.'%'))->get();

         }
            else
         {
            $ventas = Venta::all();
            
         }
         
       return view('reportes.reportesExcel', [
            'ventas' => $ventas,
            'clientes' => Cliente::all(),
            'usuarios' => User::all()
        ]);
    }
}
