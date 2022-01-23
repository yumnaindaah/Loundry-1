<?php

// @yumnaindaah_
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Paket;

class PaketController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'jenis' => 'required|string',
            'harga' => 'required|numeric'
		]);

        if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$paket = new Paket();
		$paket->jenis = $request->jenis; 
        $paket->harga = $request->harga;
        // nama kolom -> 
		$paket->save();

        $data = Paket::where('id_paket','=', $paket->id_paket)->first();
        // return $this->response->successResponseData('Data kategori berhasil ditambahkan', $data);

        return response()->json([
            'success' => true,
            'message' => 'Yeay, Kamu berhasil menambahkan Paket baru:D',
            'data'    => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'jenis_paket' => 'required|string',
            'harga_paket' => 'required|numeric'
		]);

		if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$paket = Paket::where('id_paket', $id)->first();
		$paket->jenis = $request->jenis_paket;
        $paket->harga = $request->harga_paket;
		$paket->save();

        // return $this->response->successResponse('Data kategori berhasil diubah');
        return response()->json([
            'success' => true,
            'message' => 'OK, Kamu berhasil mengupdate data Paketnya:D',
        ]);
    }

    public function delete($id)
    {
        $delete = Paket::where('id_paket', $id)->delete();

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data paketnya:D',
            ]);
                
        } else {
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data paketnya:D',
            ]);
        }
    }

    public function getAll()
    {
        $data["count"] = Paket::count();
        $data["paket"] = Paket::get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getById($id)
    {   
        $data["paket"] = Paket::where('id_paket', $id)->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}
