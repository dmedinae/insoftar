<?php

namespace Sgi\Empleado;

use Sgi\Base\BaseRepository;
use Auth;
use Hash;
use DB;

class EmpleadoRepository extends BaseRepository
{

	public function getModel()
	{
		return new Empleado;
	}

}