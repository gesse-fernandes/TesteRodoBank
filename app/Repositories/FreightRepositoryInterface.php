<?php

namespace App\Repositories;

use App\Http\Requests\FreightRequest;

//criação uma interface apenas para melhorar as comunicações.
interface FreightRepositoryInterface{
    //funcao de interface para retorno de todos os dados
    public function all();
    public function store(FreightRequest $request);
}
