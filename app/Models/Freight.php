<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    //caso queira usar uma factorie pra gerar dados falsos
    use HasFactory;
    //declaro o timestamps como falso para desabilitar colunas como create_at & update_at
    public $timestamps = false;
    //aqui defino os campos que vão ser preenchidos
    protected $fillable =
    [
        'id',
        'board',
        'vehicle_owner',
        'price_freight',
        'date_start',
        'date_end',
        'status'
    ];
    //aqui onde vai ser os campos obrigatorios na validação
    public static $rules =
    [

    ];
    //mensagens de validação
    public static $messages =
    [

    ];
}
