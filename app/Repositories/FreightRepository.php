<?php

namespace App\Repositories;

use App\Models\Freight;

class FreightRepository implements FreightRepositoryInterface{
    public function all()
    {
        return Freight::all();
    }
}

