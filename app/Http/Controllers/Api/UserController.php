<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $user;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->user = $userRepositoryInterface;
    }
    public function index()
    {
        $users = $this->user->index();
        if(empty($users))
        {
            return response()->json([
                'msg_fails'=>'Nenhum usuario encontrado'
            ]);
        }
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $create = $this->user->store($request);
        if($create)
        {
            return $create;
        }
        if(is_string($create))
        {
            return response()->json([
                'msg_fails'=>$create,
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->show($id);
        if($user){
            return response()->json($user);
        }
        return response()->json([
            'msg_fails'=>'Usuario não existe',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->update($request,$id);

        if($user)
        {
            return response()->json([
                'msg_success'=>'Usuario atualizado com sucesso',
            ]);
        }
        return response()->json([
            'msg_fails'=>'não foi possivel atualizar usuario',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->destroy($id);
        if($user)
        {
            return $user;
        }
        return response()->json([
            'msg_fails'=>'erro ao deletar usuario',
        ]);
    }


    public function findByuser(Request $request)
    {
        $user = $this->user->findByName($request);

        if($user)
        {
            return response()->json($user);
        }
        return response()->json([
            'msg_fails'=>'Usuario não existe',
        ]);
    }
}
