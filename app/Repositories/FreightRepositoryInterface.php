<?php

namespace App\Repositories;

use App\Http\Requests\FreightRequest;
use Illuminate\Http\Request;

//criação uma interface apenas para melhorar as comunicações.
interface FreightRepositoryInterface{
    //funcao de interface para retorno de todos os dados
    public function all();
    public function store(FreightRequest $request);
    public function show($id);
    public function listFreightClient();
    public function update(FreightRequest $request,$id);
    public function destroy($id);
    public function findByBoard(Request $request);
    public function findByVehile_owner(Request $request);

}
