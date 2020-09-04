<?php

namespace App\Http\Controllers;
use App\{Venta, User, Cliente, Producto};
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //   $ventas = Venta::all();
        //   $categorias = Categoria::all();

                 if(request()->ajax()){

                      return datatables()->of(Venta::latest()->get())
                            ->addIndexColumn()
                            ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="print" id="'.$data->id.'" class="print btn btn-primary btn-sm"><i class="fas fa-print"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<div class="btn-group"> <a href="ventas/'.$data->id.'/edit"><button type="button" name="editar_venta" id="'.$data->id.'" class="print btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button></a>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                     ->addColumn('cliente',function($cliente){
                    return $cliente->cliente->name;
                     })
                    ->addColumn('vendedor',function($vendedor){
                    return $vendedor->vendedor->name;
                     })
                    ->rawColumns(['action','cliente', 'vendedor'])
                    ->make(true);
            }
              
        
     
        $ventas = Venta::all();
        
        return view('modulos.ventas',compact('ventas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ventas = Venta::all();
        $clientes = Cliente::all();
        return view('modulos.crear_ventas',compact('ventas', 'clientes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 public function store(Request $request)
    {
        $listaProductos = json_decode($request->input('listaProductos'), true);
        
        $totalProductosComprados = array();
        
        foreach ($listaProductos as $key => $value) {
            /* Ingreso al array totalProductosComprado la cantidad individual */
            array_push( $totalProductosComprados, $value["cantidad"]);
            $item = 'id';
            $valor = $value['id'];
            $traerProducto = Producto::where($item, 'LIKE', $valor)->get();
            // var_dump($traerProducto[0]["stock"]);
            // var_dump($value["stock"]);
            $itemStock = 'stock';
            $cantidadVentas = $traerProducto[0]["ventas"];
            $valorStock = $value['stock'];
            $valorCantidad = $value['cantidad'] + $cantidadVentas;
            
            $productoEditar = Producto::find($value['id']);
            $productoEditar->stock = $valorStock;
            $productoEditar->ventas = $valorCantidad;
            // dd($productoEditar);

            //Aquí guardo mis datos tal como el usuario los modifico
		    $productoEditar->save();

        }
    
            $clienteEditar = Cliente::find($request->input('id_cliente'));
            $comprasClienteActual =  $clienteEditar->compras;
            /* Cantidades que el cliente compro */
            $cantidadComprada = array_sum($totalProductosComprados);
            $clienteEditar->compras = $comprasClienteActual + $cantidadComprada;
            $clienteEditar->ultima_compra = Carbon::now();
            // dd( $comprasClienteActual);
            // Aquí guardo mis datos tal como el usuario los modifico
		    $clienteEditar->save();

            /* 
                GUARDAR LA VENTA
            */
       
        $newVenta = new Venta;
        $newVenta->codigo         = $request->input('codigo');
        $newVenta->id_cliente        = $request->input('id_cliente');
        $newVenta->id_vendedor        = $request->input('id_vendedor');
        $newVenta->productos        = $request->input('listaProductos');
        $newVenta->impuesto       = $request->input('nuevoPrecioImpuesto');
        $newVenta->neto       = $request->input('nuevoPrecioNeto');
        $newVenta->total       = $request->input('totalVenta');
        $newVenta->metodo_pago       = $request->input('listaMetodoPago');
        $newVenta->fecha = Carbon::now();
      
        $newVenta->save();

        return redirect()->route('ventas.create')->with('info','Venta creada con exito'); 
        // return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ventas = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $producto = Producto::all();
        $listaDecode = $ventas['productos'];
        $list = json_decode($listaDecode, true);

            // foreach ($list as $key => $value) {
            // $sol = $value['id'];
            // $producto = Producto::select("id","stock","precio_venta")->where('id', 'LIKE', $sol)->get();
            
        // }        
        return view('modulos.editar_ventas',compact('ventas', 'clientes', 'list', 'producto'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        /*
        ------------- FORMATEADA DE LA VENTA PARA SUMAR PRODUCTOS YA COMPRADOS (CLIENTE Y PRODUCTOS)
        */
        $traer = $request->idEditarVenta;
        $traerVentas = Venta::findOrFail($traer);
        $actualizarProductos = json_decode($traerVentas['productos'], true);
        // dd($actualizarProductos);
        $totalProductosEditados = array();
        foreach ($actualizarProductos as $key => $value) {
            // dd($traerProducto);
            /* Ingreso al array totalProductosComprado la cantidad individual */
            array_push( $totalProductosEditados, $value["cantidad"]);
            $item = 'id';
            $valor = $value['id'];
            $traerProducto = Producto::findOrFail($valor);
            /* CANTIDAD DE STOCK ACTUAL MAS REFRESH DE PRODUCTOS A EDITAR */
            $valorStock = $traerProducto->stock + $value['cantidad'];
            // var_dump($valorStock);
            $valorCantidad =  $traerProducto->ventas - $value['cantidad'];
             
             $form_data = array(   
            'stock'  => $valorStock,
            'ventas' =>  $valorCantidad,
                );

            Producto::whereId($valor)->update($form_data);

        }                    
        $clienteEditar = Cliente::find($request->input('id_cliente'));
        $comprasClienteEdit =  $clienteEditar->compras;
        /* Cantidades que el cliente compro */
        $cantidadComprada = array_sum($totalProductosEditados);
        
         $clienteEditar->compras = $comprasClienteEdit - $cantidadComprada;
         $clienteEditar->ultima_compra = Carbon::now();
        // dd( $comprasClienteEdit);
        // Aquí guardo mis datos tal como el usuario los modifico
        $clienteEditar->save();

   /* 
        
        ------------- GUARDAR VENTA ACTUALIZADA Y MODIFICAR PRODUCTOS Y CLIENTES
       
   */

       $listaEditar = json_decode($request->input('listaProductos'), true);
        
       $totalProductosCompradosA = array();
        
        foreach ($listaEditar as $key => $value) {
            /* Ingreso al array totalProductosComprado la cantidad individual */
            array_push( $totalProductosCompradosA, $value["cantidad"]);
            $valorA = $value['id'];
            $traerProductoA = Producto::findOrFail($valorA);
            // var_dump($traerProductoA->stock);
            // $itemStockA = 'stock';
            $cantidadVentasA = $traerProductoA->ventas;
            $valorStockA = $traerProductoA->stock - $value['cantidad'];
            $valorCantidadA = $cantidadVentasA + $value['cantidad'];
            
            $productoEditarA = Producto::find($value['id']);
            $productoEditarA->stock = $valorStockA;
            $productoEditarA->ventas = $valorCantidadA;
            // dd($productoEditar);

            //Aquí guardo mis datos tal como el usuario los modifico
		    $productoEditarA->save();

        }
    
            $clienteEditarA = Cliente::find($request->input('id_cliente'));
            $comprasClienteActualA =  $clienteEditarA->compras;
            /* Cantidades que el cliente compro */
            $cantidadCompradaA = array_sum($totalProductosCompradosA);
            $clienteEditarA->compras = $comprasClienteActualA + $cantidadCompradaA;
            $clienteEditarA->ultima_compra = Carbon::now();
            // dd( $comprasClienteActual);
            // Aquí guardo mis datos tal como el usuario los modifico
		    $clienteEditarA->save();

    //         /* 
    //             GUARDAR LA VENTA
    //         */
       
        $newVentaA = Venta::find($request->input('idEditarVenta'));
        $newVentaA->codigo         = $request->input('codigo');
        $newVentaA->id_cliente        = $request->input('id_cliente');
        $newVentaA->id_vendedor        = $request->input('id_vendedor');
        $newVentaA->productos        = $request->input('listaProductos');
        $newVentaA->impuesto       = $request->input('nuevoPrecioImpuesto');
        $newVentaA->neto       = $request->input('nuevoPrecioNeto');
        $newVentaA->total       = $request->input('totalVenta');
        $newVentaA->metodo_pago       = $request->input('listaMetodoPago');
        $newVentaA->fecha = Carbon::now();
        $newVentaA->save();

        return redirect()->route('ventas.index')->with('info','Venta editada con exito'); 
    
        // return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
