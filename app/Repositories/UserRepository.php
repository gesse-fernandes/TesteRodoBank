<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\PermissionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface{
    public function index()
    {
        $user = User::paginate(10);
        return $user;
    }

    public function store(UserRequest $request)
    {
        $validateData = $request->all();

        $user = User::create([
            'name'=>$validateData['name'],
            'surname'=>$validateData['surname'],
            'email'=>$validateData['email'],
            'password'=>Hash::make($validateData['password']),
        ]);
        if($user)
        {
            $userRoles = PermissionsService::permissionsClient();
            $user->assignRole($userRoles);
            if( ! $token =  auth()->attempt(['email'=>$validateData['email'],'password'=>$validateData['password']])){
                return response()->json([
                    'msg_fails' => 'Erro ao criar o token'
                ], 422);
            }
            if($token)
            {
                return response()->json([
                    'access_token' => $token,
                    'type' => auth()->user()->roles[0]->name,
                    'id' => auth()->user()->id,

                ]);
            }else{
                return response()->json([
                    'msg_fails'=>'outro erro'
                ],422);
            }
        }
       else{
            return response()->json([
                'msg_fails' => 'Ouve  algum problema para cadastrar o usuario',
            ], 422);
       }
    }
    public function show($id)
    {
        $user = User::query()->where('id','=',$id)->get();
        if($user)
        {
            return $user;
        }
        return false;
    }
    public function update(UserRequest $request, $id)
    {
        $validateData = $request->all();
        $updateUser = User::find($id);
        if($updateUser)
        {
            try {
                $updateUser->update($validateData);
            } catch (\Illuminate\Database\QueryException $ex) {
                return $ex->getMessage();
            }
            return $updateUser;
        }
        return false;
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->delete();
            return response()->json([
                'msg_success' => 'deletado com sucesso',
            ]);
        }
        return false;
    }
    public function findByName(Request $request)
    {
        $validateData = $request->validate([
            'nameUser'=>'required|string|255',
        ]);
        $user = User::where('name','LIKE','%' . $validateData['nameUser'].'%')->orderBy('name')->paginate(10);
        if($user)
        {
            return $user;
        }
        return false;
    }
}
