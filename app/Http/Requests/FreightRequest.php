<?php

namespace App\Http\Requests;

use App\Models\Freight;
use Illuminate\Foundation\Http\FormRequest;

class FreightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //aqui eu autorizo já que não vai ter autenticação
    //mas por padrão é true.
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //chamada do model do array estatico rules para as validações necessárias
    public function rules()
    {
        return Freight::$rules;
    }
    //chamada do model array estatico messages para as mensagens de validação.
    public function messages()
    {
        return Freight::$messages;
    }
}
