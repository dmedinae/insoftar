<?php 

namespace App\Http\Controllers;

use Sgi\Base\BasePDF;
use Sgi\Base\BaseEXCEL;


class General extends Controller
{

    protected $data = array();
    protected $path;
    protected $upload_path;
    protected $repository;
    protected $printPDF;
    protected $printEXCEL;
    protected $encabezadoEXCEL = array();
    protected $nombreVariablesEXCEL = array();

    public function __construct()
    {
        $this->path = base_path().'/upload';
        $this->printPDF = new BasePDF;
        $this->printEXCEL = new BaseEXCEL;
    }



    public function infoFormato($id)
    {
        $formatos = $this->repository->getFormatInformation($id);
        $this->data['formatos'] = $formatos[0];
        $this->data['acciones'] = $this->repository->getAllowFormatActions($id);
    } 

    public function dinamicos($dinamico)
    {
        $i = 1;
        $datos = array();
        foreach ($dinamico as $row) {
            foreach ($row->toarray() as $key => $value) {
                $datos[$key.'_'.$i] = $value;
            }
            $i++;
        }
        return $datos;
    }

    public function listsHtml($lists)
    {
        $listas = array();
        foreach ($lists as $column => $tableName)
        {
            $column = (is_numeric($column))?'nombre':$column;
            $listas[$tableName] = $this->repository->getList($tableName, $column);
        }

        return $listas;
    }

    public function getPermission($accion = '')
    {
        foreach ($this->data['acciones'] as $row)
        {
            if(array_search($accion,(array) $row))
            {
                return $row->permiso;
            }
        }
    }    

    public function generatePrint()
    {
        return $this->printPDF->generatePrint($this->data);
    }

    public function generateInform($tipo = '0', $vista = '', $titulos = '')
    {
        if($tipo != '0')
        {
            return $this->printEXCEL->generateInform($this->data, $this->encabezadoEXCEL, $this->nombreVariablesEXCEL);    
        }
        return $this->printPDF->generateInform($this->data, $vista);
    } 
    
    public function searchAll()
    {       
        return response()->json($this->repository->getAll());
    }

    public function responseReturn($respuesta) 
    {
        if($respuesta > 0) return response()->json('Operación exitosa');
        return response()->json($this->error($respuesta), 404);
    }
    
    public function error($register)
    {

        switch ($register)
        {
            case -1:
                return 'No se encontraron resultados';
                break;                 
            
        }        
    }

    public function saveRegister($request)
    {
        $register = method_exists($this->repository, 'setRegister') ? $this->repository->setRegister($request) : $this->repository->setRegisterDefault($request);
        return $register;           
    }

    public function updateRegister($request)
    {
        // $permission = $this->getPermission('actualizar');
        $register = method_exists($this->repository, 'updateRegister') ? $this->repository->updateRegister($request,1) : $this->repository->updateRegisterDefault($request,1);
        return $register;           
    } 
}