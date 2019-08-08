<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sgi\HomeRepository as Repository;
use Sgi\SeguimientoComercial\SeguimientoComercialRepository;
use DB;
use Mail;
use DateTime;
use DateInterval;

class Home extends General
{

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        parent::__construct();
	}
	
    public function getMenu() {
        return response()->json($this->repository->getMenu());
	}

	public function getPermisos(Request $request) {
        return response()->json($this->repository->getAllowFormatActions($request->input('id')));
	}
}