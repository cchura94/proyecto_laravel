<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // estas logueado?
        if(!Auth::check()){
            return redirect("/login");
        }
        // verificar roles del usuario
        $user = Auth::user();
        foreach ($user->roles as $rol) {
            if($rol->nombre == $role){
                return $next($request);
            }
        }
        
        return redirect("/home")->with("mensaje", "No estás autorizado para ver esta sección");
    }
}
