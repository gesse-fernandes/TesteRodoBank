<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
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
        $credentials = $request->only('email','password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json([
                'error' => 'credenciais invalidas E-mail ou senha'
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
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
