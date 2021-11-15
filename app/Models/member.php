<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['id_outlet', 'nama', 'alamat', 'jenis_kelamin','telp'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "member";
    protected $primaryKey = 'id_member';
}
