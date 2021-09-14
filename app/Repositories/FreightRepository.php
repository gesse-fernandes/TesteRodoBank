<?php

namespace App\Repositories;

use App\Http\Requests\FreightRequest;
use App\Models\Freight;
use Illuminate\Http\Request;

//class para ser implementada todos os metodos criar,listar,pesquisar,deletar e atualizar.
class FreightRepository implements FreightRepositoryInterface
{
    public function all()
    {
        //chamo a função all para me retornar os dados
        $freight = Freight::all();
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
                  ->orderBy('vehicle_owner')
                  ->get();
        if($filter->isNotEmpty())
        {
            return $filter;
        }
        return false;
    }
}
