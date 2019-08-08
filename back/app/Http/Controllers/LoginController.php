<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
      $credentials = $request->only(['usuario', 'password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json('Verifique el usuario y la contraseña', 401);
      }

      return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }
    
}

/*
First get the token from JWTAuth like this:

$token = JWTAuth::getToken();

Then get the user from the token as follows:

$user = JWTAuth::toUser($token);
*/
