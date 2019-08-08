<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class VerificarPermisos
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function permisoFormato($request, $formato){
        $permiso = DB::table('permisos')
            ->select('permisos.p_'.$request->user()->perfil)
            ->where('permisos.formato','=',$formato)
            ->where('permisos.p_'.$request->user()->perfil,'<>','0')
            ->limit(1)
            ->get(); 
        if(isset($permiso[0])){
            return true;
        } 
        return false;
    }

    public function permisoAccion($request, $accion, $formato){
        $permiso = DB::table('permisos')
            ->select('permisos.p_'.$request->user()->perfil)
            ->where('permisos.formato','=',$formato)
            ->where('permisos.accion','=',$accion)
            ->limit(1)
            ->get(); 
        if(isset($permiso[0]) && $permiso[0]->{'p_'.$request->user()->perfil} != 0){
            return true;
        } 
        return false;        
    }    

    public function handle($request, Closure $next, $formato, $name, $accion = null)
    {
        $accion = ($accion)?$accion:$request->route('accion');

        if($accion && $this->permisoAccion($request, $accion, $formato)){
            return $next($request);
        }   

        if($this->permisoFormato($request, $formato)){
            if(!$accion) return $next($request);
            return redirect($name);
        }
        return redirect('/');             
    }
}
