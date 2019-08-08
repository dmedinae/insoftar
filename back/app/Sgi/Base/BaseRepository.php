<?php

namespace Sgi\Base;

use Auth;
use DB;

abstract class BaseRepository
{

	abstract public function getModel();

	public function getFormatInformation($id)
	{
       return DB::table('formatos')
            ->select('*')
            ->where('id','=',$id)
            ->limit(1)
            ->get();		
	}

	public function getMenu()
	{
		return DB::table('permisos')
                ->distinct()
                ->select('formatos.nombre','formatos.categoria','formatos.controlador','categorias.nombre as nomcat','categorias.icono')
                ->leftJoin('formatos','permisos.formato','=','formatos.id')
                ->leftJoin('categorias','formatos.categoria','=','categorias.id')
                ->where('formatos.categoria','<>','0')
                ->where('permisos.p_'.Auth::user()->perfil,'<>','0')
                ->orderBy('formatos.categoria')
                ->orderBy('formatos.nombre')
                ->get();		
	}

	public function getAllowFormatActions($id)
	{
        return DB::table('permisos')
            ->select('accion', 'link', 'p_'.Auth::user()->perfil.' AS permiso')
            ->where('formato','=',$id)
            ->where('p_'.Auth::user()->perfil, '<>', 0)
            ->get();		
	}

	public function getList($tableName, $column)
	{
		return DB::table($tableName)->orderBy($column)->pluck($column,'id');
	}

	public function setRegisterDefault($request)
	{
        $register = $this->getModel();
        $register->fill($request->all());
        $register->ingresado = Auth::user()->id;
        return $register->save() ? $register->id : 0;
	}

	public function updateRegisterDefault($request, $permission)
	{
        $register = $this->getModel()->find($request->input('id'));
        if($permission == 2 && Auth::user()->id != $register->ingresado)
        {
            return '-2';        
        }
        $register->fill($request->all());
        $register->actualizado = Auth::user()->id;
        return $register->save() ? $register->id : 0;
        }
        
        public function getAll() {
            return $this->getModel()->all();  
        }
}