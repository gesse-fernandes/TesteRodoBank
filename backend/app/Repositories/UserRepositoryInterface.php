<?php


namespace App\Repositories;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserRepositoryInterface{
    public function index();
    public function store(UserRequest $request);
    public function show($id);
    public function update(UserRequest $request,$id);
    public function destroy($id);
    public function findByName(Request $request);
}
