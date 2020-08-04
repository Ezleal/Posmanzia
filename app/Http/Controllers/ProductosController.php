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
          $productos = Producto::all();
          $categorias = Categoria::all();

                 if(request()->ajax()){

                      return datatables()->of(Producto::latest()->get())
                            ->addIndexColumn()
                            ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarProducto"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                      ->addColumn('agregar',function($agregar){
                    $button = '<div class="btn-group"> <button type="button" name="agregar" id="'.$agregar->id.'" class="edit btn btn-success btnAgregarProducto">Agregar</button></div>';
                    return $button;
                })
                
                    ->addColumn('category',function($category){
                    return $category->category->name;
                })
               
                    ->rawColumns(['action','category', 'agregar'])
                    ->make(true);
            }
        
     
        // $productos = Producto::all();
        
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
                'precio_compra'     =>  ['numeric','min:0'],
                'precio_venta'     =>  ['numeric','min:0']
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
        $newProducto->agregado = Carbon::now();
        // $newProducto->agregado = Carbon::now()->toDateString();
      
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
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Producto::findOrFail($id);
            return response()->json(['data' => $data]);
        }
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('imagen');

        if($image != '')
        {    
            $rules = array(
                'descripcion'    =>  ['required', 'string', 'max:255'],
                'codigo'     =>  ['required', 'string', 'max:191','unique:productos,codigo,'.$request->hidden_id],
                'id_categoria' => ['required','numeric', 'max:100'],
                'stock'     =>  ['numeric', 'max:100000','min:0', 'digits_between:0,10'],
                'imagen' => ['image','mimes:jpeg,jpg,png,gif','max:20000'],
                'precio_compra'     =>  ['numeric','min:0'],
                'precio_venta'     =>  ['numeric','min:0'],
            );
           
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
            
            // $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image_name = $request->username . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path("storage/profile_images/"), $image_name);
                                  
                $image_name = $request->codigo . '.' . $image->getClientOriginalExtension();
                $ruta = public_path("storage/products/".$image_name);
                Image::make($image->getRealPath())
                    ->resize(250,250, function ($constraint){ 
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);

        }
        else
        {
            $rules = array(
                'descripcion'    =>  ['required', 'string', 'max:255'],
                'codigo'     =>  ['required', 'string', 'max:191','unique:productos,codigo,'.$request->hidden_id],
                'id_categoria' => ['required','numeric', 'max:100'],
                'stock'     =>  ['numeric', 'max:100000','min:0', 'digits_between:0,10'],
                'imagen' => ['image','mimes:jpeg,jpg,png,gif','max:20000'],
                'precio_compra'     =>  ['numeric','min:0'],
                'precio_venta'     =>  ['numeric','min:0'],
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'id_categoria'       =>   $request->id_categoria,
            'codigo'        =>   $request->codigo,
            'descripcion'        =>   $request->descripcion,
            'imagen'            =>   $image_name,
            'stock'  => $request->stock,
            'precio_compra' =>  $request->precio_compra,
            'precio_venta' =>  $request->precio_venta,
            'agregado' => Carbon::now()->toDateString()
            
        );

    
     
        Producto::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
         
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
