<?php

// @yumnaindaah_

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;

Route::post('register', [UserController::class, 'register']); //registrasi -> http://127.0.0.1:8000/api/register
Route::post('login', [UserController::class, 'login']); //login -> http://127.0.0.1.:8000/api/login

// Outlet
Route::group(['middleware' => ['jwt.verify:admin, kasir, owner']], function () {
    Route::get('login/check', [UserController::class, 'loginCheck']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('outlet', [OutletController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/outlet
    Route::get('outlet/{id_outlet}', [OutletController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/outlet/2 (id)

    //report
    Route::post('transaksi/report', [TransaksiController::class, 'report']); //get report (mengapa bukan get? karena tadi ada request tgl,bulan)
});

Route::group(['middleware' => ['jwt.verify:admin,kasir']], function () {
    //Member
    Route::post('member', [MemberController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/member
    Route::put('member/{id}', [MemberController::class, 'update']); //update -> http://127.0.0.1:8000/api/member/2 (id)
    Route::delete('member/{id}', [MemberController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/member/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('member', [MemberController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/member
    Route::get('member/{id_member}', [MemberController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/member/2 (id)

    //Transaksi
    Route::post('transaksi', [TransaksiController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/transaksi
    Route::put('transaksi/status', [TransaksiController::class, 'update_status']); //update_status -> http://127.0.0.1:8000/api/transaksi/2 (id)
    Route::put('transaksi/bayar', [TransaksiController::class, 'update_bayar']); //update_pembayaran -> http://127.0.0.1:8000/api/transaksi/2 (id)
});

Route::group(['middleware' => ['jwt.verify:admin']], function () {
    Route::post('user', [UserController::class, 'insert']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'delete']);
    Route::get('user', [UserController::class, 'getAll']); //get all
    Route::get('user/{id_user}', [UserController::class, 'getById']); //get by ID

    Route::post('outlet', [OutletController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/outlet
    Route::put('outlet/{id}', [OutletController::class, 'update']); //update -> http://127.0.0.1:8000/api/outlet/2 (id)
    Route::delete('outlet/{id}', [OutletController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/outlet/2 (id) tidak perlu mengisi apa-apa di postman nya

    //Paket
    Route::post('paket', [PaketController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/paket
    Route::put('paket/{id}', [PaketController::class, 'update']); //update -> http://127.0.0.1:8000/api/paket/2 (id)
    Route::delete('paket/{id}', [PaketController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/paket/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('paket', [PaketController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/paket
    Route::get('paket/{id_paket}', [PaketController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/paket/2 (id)


    //Transaksi
    // Route::delete('transaksi/{id}', [TransaksiController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/transaksi/2 (id) tidak perlu mengisi apa-apa di postman nya
    // Route::get('transaksi', [TransaksiController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/transaksi
    // Route::get('transaksi/{id_transaksi}', [TransaksiController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/transaksi/2 (id)
});
