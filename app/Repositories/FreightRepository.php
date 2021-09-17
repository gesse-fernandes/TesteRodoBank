<?php

namespace App\Repositories;

use App\Http\Requests\FreightRequest;
use App\Models\Freight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//class para ser implementada todos os metodos criar,listar,pesquisar,deletar e atualizar.
class FreightRepository implements FreightRepositoryInterface
{
    public function all()
    {
        //chamo a função all para me retornar os dados
        $freight = Freight::query()->orderBy('vehicle_owner')->paginate(15);
        //verifico se ela existe se tem.
        if ($freight) {
            //retorno ela mesma
            return $freight;
        }
        //caso contrario envio um false para o controller.
        return false;
    }

    public function store(FreightRequest $request)
    {

       
        $validateData = $request->all();
        $freight = Freight::create([
            'board' => $validateData['board'],
            'vehicle_owner' => $validateData['vehicle_owner'],
            'price_freight' => $validateData['price_freight'],
            'date_start' => $validateData['date_start'],
            'date_end' => $validateData['date_end'],
            'status' => $validateData['status'],
            'user_id'=>$validateData['user_id'],
        ]);
        return $freight;
    }

    public function show($id)
    {
        $firstFreight = Freight::find($id);

        if($firstFreight)
        {
            return $firstFreight;
        }
        return false;
    }
    public function listFreightClient()
    {
        $id = auth()->user->id;
        $freight = Freight::query()
                   ->where('user_id','=',$id)
                   ->paginate(5);
        if($freight)
        {
            return $freight;
        }
        return false;
    }

    public function update(FreightRequest $request, $id)
    {
        $validateData = $request->all();
        $updateFreight = Freight::find($id);
        if($updateFreight)
        {
            try {
                $updateFreight->update($validateData);
            } catch (\Illuminate\Database\QueryException $ex) {
                return $ex->getMessage();
            }
            return $updateFreight;
        }
        return false;
    }
    public function destroy($id)
    {
        $deleteFreight = Freight::find($id);

        if($deleteFreight)
        {
            $deleteFreight->delete();
            return response()->json([
                'msg_success'=>'deletado com sucesso',
            ]);
        }
        return false;
    }
    public function findByBoard(Request $request)
    {
        $validateData = $request->validate([
            'boardVehicle'=>'string|required',
        ]);
        $filter = Freight::query()
                  ->where('board','LIKE','%' . $validateData['boardVehicle'] . '%')

                  ->get();
        if($filter)
        {
            return $filter;
        }
        return false;
    }

    public function findByVehile_owner(Request $request)
    {
        $validateData = $request->validate([
            'vehile_owner'=>'required|string|255',
        ]);

        $filter = Freight::query()
                  ->where('vehicle_owner','LIKE', '%' . $validateData['vehile_owner']. '%')
                 ->orderBy('vehicle_owner')
                 ->paginate(5);

        if($filter)
        {
            return $filter;
        }
        return  false;
    }
}
