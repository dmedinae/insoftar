<?php

namespace Sgi\User;

use Sgi\Base\BaseRepository;
use Auth;
use Hash;
use DB;

class UserRepository extends BaseRepository
{

	public function getModel()
	{
		return new User;
	}

    public function setRegister($request)
    {
        $register = $this->getModel();
        $register->fill($request->all());
        $register->ingresado = Auth::user()->id;  
        if($register->password != '') $register->password = Hash::make($register->password);
        return $register->save() ? $register->id : 0;
    }

    public function updateRegister($request, $permission)
    {
        $register = $this->getModel()->find($request->input('id'));
        if($permission == 2 && Auth::user()->id != $register->ingresado)
        {
            return '-2';        
        }                 
        if($request->input('password') == '') $password = $register->password;
        $register->fill($request->all());  
        $register->actualizado = Auth::user()->id;
        if(isset($password)){
            $register->password = $password;
        }else{
            if($register->password != '') $register->password = Hash::make($register->password);
        }    
        return $register->save() ? $register->id : 0;           
    }    

    public function getSearchResults($request, $permiso)
    {
        $resultado = User::Joins($permiso, Auth::user()->id);
        if($request->input('consecutivo') != '')
        {
            $resultado->where('users.id','=',$request->input('consecutivo'))->get();
        }
        else
        {
            if($request->input('estado') != '') $resultado->where('users.estado','=',$request->input('estado'));
        }

        return $resultado->get();        
    }

}