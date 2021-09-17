<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use HasRoles;
    protected $guard_name = 'api';
    protected $fillable =
    [
        'id',
        'name',
        'surname',
        'email',
        'password',

    ];

    protected $hidden =
    [
        'password',
        'token',
        'created_at',
        'updated_at'
    ];
    public static $rules =
    [
        'name' => 'string|required|max:255',
        'surname' => 'string|required|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password'=>'required|min:8'
    ];
    //mensagens de validação
    public static $messages =
    [
        'name.required' => 'Nome Obrigatório',
        'surname.required' => 'Sobrenome Obrigatório',
        'email.required' => 'E-mail Obrigatório',
        'password.required' => 'Senha Obrigatório',
        'email.email' => 'E-mail invalido',
        'email.unique'=>'Este E-mail já existe',
        'password.min' => 'Senha tem que ser pelo menos 8 caracteres',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function freight()
    {
        return $this->belongsTo(Freight::class);
    }


}
