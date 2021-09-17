<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
class User extends Model
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
