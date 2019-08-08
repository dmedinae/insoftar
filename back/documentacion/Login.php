<?php
Login

1) Illuminate\Support\Facades\Auth\AuthenticatesUsers
	Remplazar las siguientes funciones

	//Original return 'email'
    public function username()
    {
        return 'user';
    }

    //Se agrega status al request y a la consulta
    protected function credentials(Request $request)
    {
        $request['status'] = 1;
        return $request->only($this->username(), 'password', 'status');
    }    

