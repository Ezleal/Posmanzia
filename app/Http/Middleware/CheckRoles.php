<?php

namespace App\Http\Middleware;
use App\{User, Estado, Perfil};
use Illuminate\Support\Facades\Auth;



use Closure;

class CheckRoles
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
        if(Auth::user()->perfil === 1 || Auth::user()->perfil === 2 )
        {
            
            return $next($request);

        }
        return redirect('/home');
    }
}
