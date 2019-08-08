<?php

namespace Sgi\Empleado;

use Sgi\Base\Base;


class Empleado extends Base 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombres', 'apellidos', 'cedula', 'telefono', 'correo','ingresado', 'actualizado',  ];


    protected $table = 'empleado';   
}
