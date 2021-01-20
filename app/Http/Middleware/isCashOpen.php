<?php

namespace App\Http\Middleware;
use App\{Arqueo, User, Estado, Perfil};
use Illuminate\Support\Facades\Auth;

use Closure;

class isCashOpen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isCashOpen = Arqueo::select("estado_caja")
                    ->orderBy("id", "desc")
                    ->first();
        // if($isCashOpen->estado_caja === 1 || Auth::user()->perfil === 1)
        // {
            
        //     return $next($request);

        // }
        if($isCashOpen->estado_caja === 1)
        {
            
            return $next($request);

        }

        return redirect('/home')->with('cashClose','Restricción de acceso');
    }
}
