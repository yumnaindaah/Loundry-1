<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'id_outlet',
        'nama',
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    protected $table = "users";
    protected $primaryKey = "id";
    // ini digunakan untuk mengenalkan pada Laravel nya. Disini kebetulan primaryKey nya "id" berarti itu yang nanti dikenal oleh laravel.
    // jika namanya berbeda, makan disini juga perlu di setting

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
