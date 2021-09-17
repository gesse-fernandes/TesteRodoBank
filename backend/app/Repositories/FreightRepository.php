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
        $id = $validateData['user_id']??null;
        $freight = Freight::create([
            'board' => $validateData['board'],
            'vehicle_owner' => $validateData['vehicle_owner'],
            'price_freight' => $validateData['price_freight'],
            'date_start' => $validateData['date_start'],
            'date_end' => $validateData['date_end'],
            'status' => $validateData['status'],
            'user_id'=>$id,
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
        $id = auth()->user()->id;
        $freight = Freight::query()
                   ->where('user_id','=',$id)
                   ->paginate(5);
        if($freight)
        {
            return $freight;
        }
        return false;
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'board' => 'string|required',
            'vehicle_owner' => 'string|required',
            'price_freight' => 'required',
            'date_start' => 'required|date_format:Y-m-d',
            'date_end' => 'required|date_format:Y-m-d',
            'status' => 'required|in:Iniciado,em trânsito,concluido',
            'user_id' => '',
        ]);
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
        ],[
            'boardVehicle.required'=>'Placa do veiculo Obrigatório'
        ]);
        $filter = Freight::query()
                  ->where('board','LIKE','%' . $validateData['boardVehicle'] . '%')

                  ->get()->first();
        if($filter)
        {
            return $filter;
        }
        return false;
    }

    public function findByVehile_owner(Request $request)
    {
        $validateData = $request->validate([
            'vehile_owner'=>'required|string|max:255',
        ],[
            'vehile_owner.required'=>'Nome do dono do veiculo Obrigatório'
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
