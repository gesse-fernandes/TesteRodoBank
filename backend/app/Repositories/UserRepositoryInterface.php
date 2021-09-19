<?php


namespace App\Repositories;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface{
    public function index(Request $request);
    public function store(UserRequest $request);
    public function show($id);
    public function update(UserRequest $request,$id);
    public function destroy($id);
    public function findByName(Request $request);
    public function getResults(array $data, int $totalPage);
}
