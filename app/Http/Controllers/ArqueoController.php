<?php

namespace App\Http\Controllers;

use App\{Arqueo, Venta, User, Cliente, Producto};
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;


class ArqueoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
                'caja'    =>  ['required'],
                'id_user'     =>  ['required', 'numeric'],
                'fecha_inicio' => ['required'],
                'hora_inicio'     =>  ['required'],
                'monto_inicial'     =>  ['required','numeric']
            );

        $request->validate($rules);

        // if($error->fails())
        // {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }

        // ACA TRAEMOS LA INFORMACIÓN DE LA ULTIMA APERTURA DE CAJA
        $ultimoArqueo = Arqueo::select("*")
                    ->orderBy("id", "desc")
                    ->take(1)->get();
        $idArqueo = Arqueo::select("id")
        ->orderBy("id", "desc")
        ->first();
        // $cantidadVentasArqueo = count(Venta::where('fecha','>', $ultimoArqueo[0]->created_at) 
        // ->where('metodo_pago', '=', 'Efectivo')
        // ->get());

        // FIN DE APERTURA DE ARQUEO
       
        $newArqueo = new Arqueo;
        $newArqueo->id_caja         = $request->input('caja');
        $newArqueo->id_user        = $request->input('id_user');
        $newArqueo->fecha_inicio        = $request->input('fecha_inicio');
        $newArqueo->hora_inicio        = $request->input('hora_inicio');
        $newArqueo->monto_inicio        = $request->input('monto_inicial');
        // $newArqueo->total_ventas      = $cantidadVentasArqueo;
        // $newArqueo->agregado = Carbon::now()->toDateString();

        $newArqueo->save();
        
     return redirect()->route('home')->with('apertura','Apertura de caja'); 

        // return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function show(Arqueo $arqueo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function edit(Arqueo $arqueo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arqueo $arqueo)
    {
        // ACA TRAEMOS LA INFORMACIÓN DE LA ULTIMA APERTURA DE CAJA
        $ultimoArqueo = Arqueo::select("*")
                    ->orderBy("id", "desc")
                    ->take(1)->get();

        $cantidadVentasArqueo = count(Venta::where('fecha','>', $ultimoArqueo[0]->created_at) 
        ->where('metodo_pago', '=', 'Efectivo')
        ->get());
        // $arqueo->id_caja         = $request->input('caja');
        // $arqueo->id_user        = $request->input('id_user');
        // $arqueo->fecha_inicio        = $request->input('fecha_inicio');
        // $arqueo->hora_inicio        = $request->input('hora_inicio');
        // $arqueo->monto_inicio        = $request->input('monto_inicial');

        $rules = array(
                'monto_cierre'    =>  ['required', 'numeric'],
                'saldo_cierre'     =>  ['required', 'numeric'],
                'cierre_caja' => ['required', 'numeric'],
            );

        $request->validate($rules);

        $arqueo->fecha_cierre = Carbon::now()->format('Y-m-d');;
        $arqueo->hora_cierre = Carbon::now()->toTimeString();
        $arqueo->monto_cierre = $request->input('monto_cierre');
        $arqueo->saldo_cierre = $request->input('saldo_cierre');
        $arqueo->cierre_caja = $request->input('cierre_caja');
        $arqueo->observaciones = $request->input('observaciones');
        $arqueo->estado_caja = 0;
        $arqueo->total_ventas =  $cantidadVentasArqueo;
        $arqueo->save();

        return redirect()->route('home')->with('cierre','Cierre de caja'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arqueo  $arqueo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arqueo $arqueo)
    {
        //
    }
}
