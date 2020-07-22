<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\{User, Estado, Perfil};
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;



class UsersController extends Controller
{
    public $activarId;
    public $activarUsuario;
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function __construct(UsersRepository $Users)
    {
        $this->Users = $Users;
        $this->middleware('auth');
     
    }
    
    public function index()
    {
         if(request()->ajax())
        {
            return datatables()->of(User::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group"> <button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm btnEditarUsuario"><i class="fas fa-pencil-alt"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    //   $datas = $this->Users->traerUsers();
            // var_dump($dal);   
        $perfiles = Perfil::all();
        $estados = Estado::all();
       
        return view('modulos.usuarios',compact('perfiles', 'estados'));
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
    // 
   public function store(Request $request)
    {   
        
       
        $rules = array(
                'name'    =>  ['required', 'string', 'max:255'],
                'username'     =>  ['required', 'string', 'max:255','unique:users'],
                'email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
                'foto' => ['image','mimes:jpeg,jpg,png,gif','max:20000'],
                'estado'=> ['nullable','required','string'],
                'perfil' => ['required','numeric', 'max:10'],
                'password' => ['string', 'min:8', 'confirmed'],

            );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
       
        $newUser = new User;
        $newUser->name         = $request->input('name');
        $newUser->username        = $request->input('username');
        $newUser->email        = $request->input('email');
        $newUser->password = Hash::make($request->input('password')); 
        $newUser->perfil = $request->input('perfil'); 
        $newUser->estado = $request->input('estado_hidden'); 
        // if ($request->hasFile('foto')) {
        
        // $image_name = $request->username . '.' . $image->getClientOriginalExtension();
        // $image->move(public_path("storage/profile_images/"), $image_name);
        // $path = $request->file('foto')->store("public/profile_images/");    
        // $nombreArchivo = $request->username . '.' . $image->getClientOriginalExtension();
        // $nombreArchivo = basename($path);
        
        // $newUser->foto = $image_name;

        // }
        if ($request->hasFile('foto')){
                $image = $request->file('foto');                     
                $nombre = $request->username . '.' . $image->getClientOriginalExtension();
                $ruta = public_path("storage/profile_images/".$nombre);
                Image::make($image->getRealPath())
                    ->resize(250,250, function ($constraint){ 
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);
                    $newUser->foto = $nombre;
            }

      
        $newUser->save();

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
       $usuarioEditar = User::findOrFail($id);
        return view('modulos.usuarios', compact('usuarioEditar'));
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
            // $data = User::findOrFail($id);
            $data = $this->Users->UsersPorId($id);
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
        $image_name = $request->hidden_image;
        $image = $request->file('foto');
        $pass = $request->password;
        $conf = $request->password_confirmation;
        
    if($pass != '' || $conf != ''){
        if($image != '')
        {   
            $rules = array(
                'name'    =>  'required', 'string', 'max:255',
                'username'     =>  'required', 'string', 'max:255',
                'email'     =>'required', 'string', 'email', 'max:255',
                'foto' => 'image','mimes:jpeg,jpg,png,gif','max:2048',
                'perfil' => 'required','numeric', 'max:10',
                'estado' => 'required','numeric', 'max:10',
                'password' => 'string', 'min:8', 'confirmed',
               

                
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            // ACA SE ASIGNA UN NOMBRE A LA IMAGEN, SE REDIMENSIONA Y COMPRIME (72) -> Image Intervention
            if ($request->hasFile('foto')){
                $image = $request->file('foto');                     
                $image_name = $request->username . '.' . $image->getClientOriginalExtension();
                $ruta = public_path("storage/profile_images/".$image_name);
                Image::make($image->getRealPath())
                    ->resize(250,250, function ($constraint){ 
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);
            }

        }
        else
        {
            $rules = array(
                'name'    =>  'required', 'string', 'max:255',
                'username'     =>  'required', 'string', 'max:255',
                'email'     =>  'required', 'string', 'email', 'max:255',
                'foto' => 'image','mimes:jpeg,jpg,png,gif','max:2048',
                'perfil' => 'required','numeric', 'max:10',
                'estado' => 'required','numeric', 'max:10',
                'password' => ['string', 'min:8', 'confirmed'],
                
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'name'       =>   $request->name,
            'username'        =>   $request->username,
            'email'        =>   $request->email,
            'foto'            =>   $image_name,
            'perfil'  => $request->perfil,
            'estado' =>  $request->estado_hidden,
            'password' => Hash::make($request->password)
        );

    }
    else{
        if($image != '')
        {   
            $rules = array(
                'name'    =>  'required', 'string', 'max:255',
                'username'     =>  'required', 'string', 'max:255',
                'email'     =>'required', 'string', 'email', 'max:255',
                'foto' => 'image','mimes:jpeg,jpg,png,gif','max:2048',
                'perfil' => 'required','numeric', 'max:10',
                'estado' => 'required','numeric', 'max:10',
                // 'password' => 'string', 'min:8', 'confirmed',
               

                
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
            
            // $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image_name = $request->username . '.' . $image->getClientOriginalExtension();
            // $image->move(public_path("storage/profile_images/"), $image_name);
               if ($request->hasFile('foto')){
                $image = $request->file('foto');                     
                $image_name = $request->username . '.' . $image->getClientOriginalExtension();
                $ruta = public_path("storage/profile_images/".$image_name);
                Image::make($image->getRealPath())
                    ->resize(250,250, function ($constraint){ 
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);
            }

        }
        else
        {
            $rules = array(
                'name'    =>  'required', 'string', 'max:255',
                'username'     =>  'required', 'string', 'max:255',
                'email'     =>  'required', 'string', 'email', 'max:255',
                'foto' => 'image','mimes:jpeg,jpg,png,gif','max:2048',
                'perfil' => 'required','numeric', 'max:10',
                'estado' => 'required','numeric', 'max:10',
                // 'password' => ['string', 'min:8', 'confirmed'],
                
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'name'       =>   $request->name,
            'username'        =>   $request->username,
            'email'        =>   $request->email,
            'foto'            =>   $image_name,
            'perfil'  => $request->perfil,
            'estado' =>  $request->estado_hidden,
            // 'password' => $request->$pass
        );

    }
     
        User::whereId($request->hidden_id)->update($form_data);

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
        // $data = User::findOrFail($id);
        $data = $this->Users->UsersPorId($id);
        $data->delete();
        // return view('modulos.usuarios');
    }

}
