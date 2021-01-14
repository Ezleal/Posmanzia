<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\{Venta, User, Cliente, Producto, Perfil, Estado};
use Illuminate\Support\Facades\Auth;
 /* |--------------------------------------------------------------------------
    |  SE UTILIZAN ESTAS LIBRERIAS PARA ESTABLECER LA FECHA DE ULTIMO LOGIN
    |  use Carbon\Carbon;
    |  use Illuminate\Http\Request;
    |--------------------------------------------------------------------------*/
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


     /* LA FUNCION AUTENTICATED ESTABLECE EL ULTIMO LOGIN DEL USUARIO */
    
     public function authenticated(Request $request, $user)
     {
      /* $date = Carbon::now();
       $date->toDateString();                          // 1975-12-25
       $date->toFormattedDateString();                 // Dec 25, 1975
       $date->toTimeString();                          // 14:15:16
       $date->toDateTimeString();                      // 1975-12-25 14:15:16 */
    //    $date = Carbon::now();
    //    $date = $date->format('l jS \\of F Y h:i:s A');    
       $user->ultima_login = Carbon::now()->toDateTimeString();
       $user->save();
}
    public function __construct()

    {  
     
        $this->middleware(['guest'])->except('logout');

    }
}
