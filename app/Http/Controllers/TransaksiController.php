<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//yang ditambahkan
use Illuminate\Support\Facades\Validator;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_member'         => 'required|string',
            'tgl'               => 'required|date',
            'lama_pengerjaan'   => 'required|string',
            //'batas_waktu'  => 'required|date',
            //'tgl_bayar'    => 'required|date',
            // 'status'       => 'required|string',
            // 'dibayar'      => 'required|string',
            'id_user'      => 'required',
            //kolom di postman
        ]);

        if ($validator->fails()) {
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
        }

        $tgl_transaksi = date_create($request->tgl);
        date_add($tgl_transaksi, date_interval_create_from_date_string($request->lama_pengerjaan . " days"));
        $batas_waktu = date_format($tgl_transaksi, 'Y-m-d');

        $transaksi = new Transaksi();
        $transaksi->id_member   = $request->id_member;
        $transaksi->tgl         = $request->tgl;
        $transaksi->batas_waktu = $batas_waktu;
        $transaksi->id_user     = $request->id_user;
        // kolom di database       kolom di form   
        $transaksi->save();

        $data = Transaksi::where('id_transaksi', '=', $transaksi->id_transaksi)->first();
        // return $this->response->successResponseData('Data kategori berhasil ditambahkan', $data);

        return response()->json([
            'success' => true,
            'message' => 'Yeay, Kamu berhasil menambahkan transaksi baru:D',
            'data'    => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|string',
            'dibayar' => 'required|string'
        ]);

        if ($validator->fails()) {
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
        }

        $transaksi = Transaksi::where('id_transaksi', $id)->first();
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->harga = $request->harga_transaksi;
        $transaksi->save();

        // return $this->response->successResponse('Data kategori berhasil diubah');
        return response()->json([
            'success' => true,
            'message' => 'OK, Kamu berhasil mengupdate data transaksinya:D',
        ]);
    }
}
