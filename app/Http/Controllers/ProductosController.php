<?php

namespace App\Http\Controllers;

use App\{Producto, Categoria};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
class ProductosController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
                 if(request()->ajax())
                  {
                      return datatables()->of(Producto::latest()->get())
                            ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarProducto"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
     
        $productos = Producto::all();
        $categorias = Categoria::all();
        
        return view('modulos.productos',compact('productos', 'categorias'));
        
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
                'descripcion'    =>  ['required', 'string', 'max:255'],
                'codigo'     =>  ['required', 'string', 'max:255','unique:productos,codigo'],
                'id_categoria' => ['required','numeric', 'max:100'],
                'stock'     =>  ['numeric', 'max:100000','min:0', 'digits_between:0,10'],
                'imagen' => ['image','mimes:jpeg,jpg,png,gif','max:20000'],
                'precio_compra'     =>  ['numeric','min:0','digits_between:0,10'],
                'precio_venta'     =>  ['numeric','min:0','digits_between:0,10'],
            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $newProducto = new Producto;
        $newProducto->id_categoria         = $request->input('id_categoria');
        $newProducto->descripcion        = $request->input('descripcion');
        $newProducto->codigo        = $request->input('codigo');
        $newProducto->stock        = $request->input('stock');
        $newProducto->precio_compra        = $request->input('precio_compra');
        $newProducto->precio_venta       = $request->input('precio_venta');
        $newProducto->agregado = Carbon::now()->toDateString();
      
        if ($request->hasFile('imagen')){
                $image = $request->file('imagen');                     
                $nombre = $request->codigo . '.' . $image->getClientOriginalExtension();
                $ruta = public_path("storage/products/".$nombre);
                Image::make($image->getRealPath())
                    ->resize(250,250, function ($constraint){ 
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);
                    $newProducto->imagen = $nombre;
            }

      
        $newProducto->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $data = Producto::findOrFail($id);
        $data->delete();
     
    }
}
