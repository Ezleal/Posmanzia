<?php

namespace App\Http\Controllers;
use App\{Arqueo, Venta, User, Cliente, Producto, Categoria};
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            //GRAFICO CIRCULAR
        $usuarios = User::All();
        $clientes = Cliente::All();
        $total = DB::table('productos')->sum('ventas');
        $colores = array("red", "green","aqua","magenta","yellow","blue");
        $productos = Producto::select("*")
                    ->orderBy("ventas", "desc")
                    ->take(6)->get();

        //  SECCIONES ALTA Y MEDIA
        $productosAgregados = Producto::select("*")
                    ->orderBy("agregado", "desc")
                    ->take(6)->get();
        $totalVentas = number_format(DB::table('ventas')->sum('neto'),2);
        $totalCategorias = number_format(Categoria::all()->count());
        $totalClientes = number_format(Cliente::all()->count());
        $totalProductos = number_format(Producto::all()->count());
        
        //ARQUEO DE CAJA
        $arqueos = Arqueo::all();
        $ultimoArqueo = Arqueo::select("*")
                    ->orderBy("id", "desc")
                    ->take(1)->get();
        $idArqueo = Arqueo::select("id")
        ->orderBy("id", "desc")
        ->first();
        $cantidadVentasArqueo = count(Venta::where('fecha','like', $ultimoArqueo[0]->fecha_inicio.'%') 
        ->where('metodo_pago', '=', 'Efectivo')
        ->get());
        $fechaNow = Carbon::now()->format('Y-m-d');

        $sumVentas = round(DB::table('ventas')
                ->where('fecha', 'like',$ultimoArqueo[0]->fecha_inicio.'%' )
                ->where('metodo_pago', '=', 'Efectivo')
                ->sum('total'),2);
        $monFin = $sumVentas + $ultimoArqueo[0]->monto_inicio;
        $hora = Carbon::now()->toTimeString();
        
        return view('home',compact('totalVentas', 'totalCategorias', 'totalClientes','totalProductos','productos','colores', 'total', 'usuarios', 'clientes','productosAgregados', 'arqueos','idArqueo','cantidadVentasArqueo', 'ultimoArqueo', 'fechaNow', 'hora','monFin'));
    }
}
