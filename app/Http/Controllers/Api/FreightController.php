<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreightRequest;
use App\Models\Freight;
use App\Repositories\FreightRepositoryInterface;
use Illuminate\Http\Request;

class FreightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $freight;

     public function __construct(FreightRepositoryInterface $freightRepositoryInterface)
     {
        $this->freight = $freightRepositoryInterface;
     }
    public function index()
    {
       $freights = $this->freight->all();

        if(empty($freights))
        {
            return response()->json([
                'msg_fails'=>'Nenhum frete encontrado'
            ]);
        }
        return response()->json($freights);

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
    public function store(FreightRequest $request)
    {
        $create = $this->freight->store($request);
        if($create)
        {
            return response()->json([
                $create,
            ]);
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
        $show = $this->freight->show($id);
        if($show)
        {
            return response()->json([
                $show
            ]);
        }
        return response()->json([
            'msg_fails'=>'Nenhum frete encontrado',
        ]);
    }

    public function listFreightClient()
    {
        $list = $this->freight->listFreightClient();
        if($list)
        {
            return response()->json($list);
        }
        return response()->json([
            'msg_fails'=>'Nenhum frete encontrado a este usuario',
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
    public function update(FreightRequest $request, $id)
    {
        $update =$this->freight->update($request,$id);
        if($update)
        {
            return response()->json([
                'msg_success'=>'Frete atualizado com sucesso',
            ]);
        }
        return response()->json([
            'msg_fails'=>'Não foi possivel atualizar o frete',
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
        $freight = $this->freight->destroy($id);
        if($freight)
        {
            return $freight;
        }
        return response()->json([
            'msg_fails'=>'error ao deletar o frete',
        ]);
    }
    public function findByBoard(Request $request)
    {
        $filter = $this->freight->findByBoard($request);
        if($filter)
        {
            return response()->json([
                $filter
            ]);
        }
        return response()->json([
            'msg_fails'=>'placa do veiculo não existe'
        ]);
    }
    public function findByVehile_owner(Request $request)
    {
        $filter = $this->freight->findByVehile_owner($request);
        if($filter)
        {
            return response()->json([
                $filter
            ]);
        }
        return response()->json([
            'msg_fails'=>'Dono não encontrado',
        ]);
    }
}
