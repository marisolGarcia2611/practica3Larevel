<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use App\accounts;
use Closure;

class cuentaActiva
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
        $accou=accounts::where('user_id',$request->codigoDeUsuario)->first();
        if($accou->estado=='activado')
        {
            return $next($request);
        
        }
        return abort('Validacion fallida',401);
    
    }
}
