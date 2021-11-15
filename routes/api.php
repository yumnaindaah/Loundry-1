<?php

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
Route::group(['middleware' => ['jwt.verify:admin']], function () {
    Route::post('outlet', [OutletController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/outlet
    Route::put('outlet/{id}', [OutletController::class, 'update']); //update -> http://127.0.0.1:8000/api/outlet/2 (id)
    Route::delete('outlet/{id}', [OutletController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/outlet/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('outlet', [OutletController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/outlet
    Route::get('outlet/{id_outlet}', [OutletController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/outlet/2 (id)

    //Paket
    Route::post('paket', [PaketController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/paket
    Route::put('paket/{id}', [PaketController::class, 'update']); //update -> http://127.0.0.1:8000/api/paket/2 (id)
    Route::delete('paket/{id}', [PaketController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/paket/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('paket', [PaketController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/paket
    Route::get('paket/{id_paket}', [PaketController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/paket/2 (id)

    //Member
    Route::post('member', [MemberController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/member
    Route::put('member/{id}', [MemberController::class, 'update']); //update -> http://127.0.0.1:8000/api/member/2 (id)
    Route::delete('member/{id}', [MemberController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/member/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('member', [MemberController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/member
    Route::get('member/{id_member}', [MemberController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/member/2 (id)

    //Transaksi
    Route::post('transaksi', [TransaksiController::class, 'insert']); //insert -> http://127.0.0.1:8000/api/transaksi
    Route::put('transaksi/{id}', [TransaksiController::class, 'update']); //update -> http://127.0.0.1:8000/api/transaksi/2 (id)
    Route::delete('transaksi/{id}', [TransaksiController::class, 'delete']); //delete -> http://127.0.0.1:8000/api/transaksi/2 (id) tidak perlu mengisi apa-apa di postman nya
    Route::get('transaksi', [TransaksiController::class, 'getAll']); //get all -> http://127.0.0.1:8000/api/transaksi
    Route::get('transaksi/{id_transaksi}', [TransaksiController::class, 'getById']); //get id -> http://127.0.0.1:8000/api/transaksi/2 (id)
});
