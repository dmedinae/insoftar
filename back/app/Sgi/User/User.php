<?php

namespace Sgi\User;

use Sgi\Base\Base;


class User extends Base 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'empresa','cedula', 'fecha', 'telefono', 'celular', 'direccion', 'mailp', 'usuario', 'password', 'perfil', 'estado', 'ingresado', 'actualizado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';



    public function scopeJoins($query, $permiso = '', $userId = '')
    {
        if($permiso == '2')
        {
            $query->where($this->table.'.ingresado','=',$userId);
        }
/*
        $query->leftjoin('registro_empresa','seguimiento_comercial.empresa','=','registro_empresa.id')
            ->addSelect('registro_empresa.razon AS nombreEmpresa')
            ->leftjoin('registro_empresa_contactos','seguimiento_comercial.contacto','=','registro_empresa_contactos.id')
            ->addSelect('registro_empresa_contactos.nombre AS nombreContacto')
            ->leftjoin('lista_linea_negocio','seguimiento_comercial.linea_negocio','=','lista_linea_negocio.id')
            ->addSelect('lista_linea_negocio.nombre AS nombreLineaNegocio')
            ->leftjoin('lista_gestion_comercial','seguimiento_comercial.gestion_comercial','=','lista_gestion_comercial.id')
            ->addSelect('lista_gestion_comercial.nombre AS nombreGestionComercial')
            ->addSelect($this->table.'.*');
*/
    }     
}
