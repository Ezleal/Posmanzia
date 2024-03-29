<?php

namespace App\Http\Middleware;
use App\{User, Estado, Perfil};
use Illuminate\Support\Facades\Auth;

use Closure;

class isAdmin
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
        if(Auth::user()->perfil === 1)
        {
            
            return $next($request);

        }
        return redirect('/home')->with('isAdmin','Restricción de acceso');
        
    }
}
