<?php

namespace App\Http\Middleware;
use App\{User, Estado, Perfil};
use Illuminate\Support\Facades\Auth;


use Closure;

class notActive
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

         if(Auth::user()->estado === 0)
        {
            
            
            return redirect('/home')->with('notActive','Usuario Desactivado');

        }
        return $next($request);
    }



}
