<?php

namespace App\Http\Middleware;

use Closure;

class permisoUserDelete
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
        $user==DB::table('personal_access_tokens')
        ->where('abilities',$request->permiso)->first();
        //user:user significaria que tiner los permisos como:
        //elminar productos, eliminar comentarios
        if($user->abilities=='user:delete')
        {
            return $next($request);
        
        }
        return abort('Validacion fallida',401);
    }
}
