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
        'board'=> 'string|required|unique:freights',
        'vehicle_owner'=>'string|required',
        'price_freight'=>'required',
        'date_start'=> 'required|date_format:Y-m-d',
        'date_end'=> 'required|date_format:Y-m-d',
        'status'=>'required|in:Iniciado,em trânsito,concluido'
    ];
    //mensagens de validação
    public static $messages =
    [
        'board.required'=>'Placa do veiculo é Obrigatória',
        'vehicle_owner.required'=>'Dono do Veiculo é Obrigatório',
        'price_freight.required'=>'Valor do frete Obrigatóio',
        'date_start.required'=>'Data inicio Obrigatória',
        'date_end.required'=>'Data fim Obrigatória',
        'status.required'=>'Status Obrigatório',
    ];
}
