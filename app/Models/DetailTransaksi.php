<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = ['id_detail_transaksi', 'id_transaksi', 'id_paket', 'berat'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = "transaksi";
    protected $primaryKey = 'id_transaksi';
}
