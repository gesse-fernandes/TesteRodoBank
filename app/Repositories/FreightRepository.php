<?php

namespace App\Repositories;

use App\Http\Requests\FreightRequest;
use App\Models\Freight;
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
}
