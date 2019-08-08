<?php

namespace App;

use Sgi\Base\Base;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Base implements JWTSubject
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

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }    
}
