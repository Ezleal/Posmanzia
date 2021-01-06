<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Cliente;
use Illuminate\Support\Facades\Auth;



class ClientesController extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth']);     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         if(Auth::user()->perfil === 1)
        {
         if(request()->ajax())
        {
            return datatables()->of(Cliente::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarCliente"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        }
        else if(Auth::user()->perfil === 2)
        {
               if(request()->ajax())
        {
            return datatables()->of(Cliente::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group ml-3"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarCliente"><i class="fas fa-pencil-alt"></i></button>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        }
        else
        {
             if(request()->ajax())
        {
            return datatables()->of(Cliente::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group ml-3"> <button type="button" name="none" id="none" class="none btn btn-danger btn-sm"><i class="fas fa-times-circle"></i></button>';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        }




        return view('modulos.clientes');
        // $users = User::all();
        // return view('modulos.usuarios',compact('users'));
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
                'name'    =>  ['required', 'string', 'max:191'],           
                'documento'     =>  ['required', 'string', 'max:191','unique:clientes,documento,'.$request->hidden_id],          
                'direccion'     =>  ['required', 'string', 'max:191'],
                'telefono'    =>  ['string', 'max:20'],
                'fecha_nacimiento'    =>  ['date'],
                'email'     =>['required', 'string', 'email', 'max:191','unique:clientes,email,'.$request->hidden_id],
            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $newCliente = new Cliente;
        $newCliente->name  = $request->input('name');
        $newCliente->documento  = $request->input('documento');
        $newCliente->direccion  = $request->input('direccion');
        $newCliente->telefono  = $request->input('telefono');
        $newCliente->fecha_nacimiento  = $request->input('fecha_nacimiento');
        $newCliente->email  = $request->input('email');
        $newCliente->agregado  = Carbon::now();
        $newCliente->save();

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $clienteEditar = Cliente::findOrFail($id);
        return view('modulos.clientes', compact('clienteEditar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Cliente::findOrFail($id);
            return response()->json(['data' => $data]);
        }
      
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
         
            $rules = array(
                'name'    =>  ['required', 'string', 'max:191'],           
                'documento'     =>  ['required', 'string', 'max:191','unique:clientes,documento,'.$request->hidden_id],          
                'direccion'     =>  ['required', 'string', 'max:191'],
                'telefono'    =>  ['string', 'max:20'],
                'fecha_nacimiento'    =>  ['date'],
                'email'     =>['required', 'string', 'email', 'max:191','unique:clientes,email,'.$request->hidden_id],
                // 'compras'    =>  ['numeric', 'max:20'],

            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

     
         $form_data = array(

                'name'  => $request->name,
                'documento'=> $request->documento,
                'direccion'=> $request->direccion,
                'telefono'=> $request->telefono,
                'fecha_nacimiento'=> $request->fecha_nacimiento,
                'email'=> $request->email,

            );


     
        Cliente::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Cliente::findOrFail($id);
        $data->delete();
        // return view('modulos.usuarios');
    }
}
