<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login', 'unauthorized']]);
    }

    public function unauthorized()
    {
        return response()->json([
            'error'=>'não autorizado'
        ],401);
    }
    public function login(Request $request)
    {

        $credentials = $request->validate(['email' => 'required', 'password' => 'required'],[
            'email.required'=>'E-mail Obrigatorio',
            'password.required'=>'Senha Obrigatoria'
        ]);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => $this->unauthorized(),
            ], 401);
        }
        return $this->respondWithToken($token);
    }
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'Bearer',
            'id'=>auth()->user()->id,
            'type'=>auth()->user()->roles[0]->guard_name,
            'type_role'=>auth()->user()->roles[0]->name,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return ['error'=>''];
    }
    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json([
            'token'=>$token,
        ]);
    }
}
