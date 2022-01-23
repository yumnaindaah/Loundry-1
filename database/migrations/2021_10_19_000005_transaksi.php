<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// @yumnaindaah_

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi');
            $table->unsignedBigInteger('id_member');
            $table->date('tgl');
            $table->date('batas_waktu');
            $table->date('tgl_bayar');
            $table->enum('status', ['baru', 'selesai', 'proses', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            // cascade digunakan ketika id pada users dihapus maka id transaksinya juga akan kehapus.
            // Memang ini tidak baik, tetapi ini untuk menggulangi eror

            $table->foreign('id_member')->references('id_member')->on('member')->onDelete('cascade');
            // id_member pertama milik tabel transaksi
            // id member kedua milik tabel member
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
