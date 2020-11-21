<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\DB;
use App\User;
use Closure;

class permisoAdmin
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
      
        $admin==DB::table('personal_access_tokens')
        ->where('abilities',$request->permiso)->first();
        if($admin->abilities=='admin:admin')
        {
            return $next($request);
        
        }
        return abort('Validacion fallida',401);
    }
}
