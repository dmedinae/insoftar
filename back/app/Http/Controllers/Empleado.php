<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sgi\Empleado\EmpleadoRepository as Repository;
use App\Http\Requests\EmpleadoRequest as FormatRequest;
use Auth;
use PDF;
use DB;
use Hash;

class Empleado extends General
{

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
        $this->data['carpeta'] = 'empleado';
        $this->upload_path = $this->path.'/'.$this->data['carpeta'];        
    }

    public function create(FormatRequest $request)
    {
        if($request->hasFile('foto')){
            $foto = $request->input('clave').'.'.$request->file('foto')->getClientOriginalExtension();  
            $request->file('foto')->move($this->upload_path, $foto); 
            $request->request->add(['photo' => $foto]);
        }        
        return $this->responseReturn($this->saveRegister($request));
    } 
    
    public function update(FormatRequest $request)
    {
        if($request->hasFile('foto')){
            $foto = $request->input('clave').'.'.$request->file('foto')->getClientOriginalExtension();  
            $request->file('foto')->move($this->upload_path, $foto); 
            $request->request->add(['photo' => $foto]);
        }        
        return $this->responseReturn($this->updateRegister($request));
    }
}