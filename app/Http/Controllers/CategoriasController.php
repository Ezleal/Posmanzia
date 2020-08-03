<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;



class CategoriasController extends Controller
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
   public function index()
    {
         if(request()->ajax())
        {
            return datatables()->of(Categoria::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarCategoria"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('modulos.categorias');
        // $users = User::all();
        // return view('modulos.usuarios',compact('users'));
    }

    public function store(Request $request)
    {   
        $rules = array(
                'name'    =>  ['required', 'string', 'max:191','unique:categorias'],
            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $newCategory = new Categoria;
        $newCategory->name  = $request->input('name');

     
        $newCategory->save();

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
       $categoriaEditar = Categoria::findOrFail($id);
        return view('modulos.categorias', compact('categoriaEditar'));
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
            $data = Categoria::findOrFail($id);
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
                'name'    =>  ['required', 'string', 'max:191','unique:categorias,name,'.$request->hidden_id],           
             );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

     
         $form_data = array(

                'name'  => $request->name,

            );


     
        Categoria::whereId($request->hidden_id)->update($form_data);

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
        $data = Categoria::findOrFail($id);
        $data->delete();
        // return view('modulos.usuarios');
    }

}
