<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\User;
class permisoUser
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
        //user:user significaria que tiene todos los permisos que un usuario puede tener como
        //elminar productos, eliminar comentarios, hacer comentarios, registrar productos y hacer actulizaciones de ambos 
        if($user->abilities=='user:user')
        {
            return $next($request);
        
        }
        return abort('Validacion fallida',401);
    }
}
