<?php

//@yumnaindaah_

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// yang perlu ditambahkan 
use Illuminate\Support\Facades\Validator;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama_outlet' => 'required|string'
		]);

        if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$outlet = new Outlet();
		$outlet->nama_outlet = $request->nama_outlet; 
        // nama kolom -> 
		$outlet->save();

        $data = Outlet::where('id_outlet','=', $outlet->id_outlet)->first();
        // return $this->response->successResponseData('Data kategori berhasil ditambahkan', $data);

        return response()->json([
            'success' => true,
            'message' => 'Yeay, Kamu berhasil menambahkan Outlet baru:D',
            'data'    => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'nama_outlet' => 'required|string'
		]);

		if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$outlet = Outlet::where('id_outlet', $id)->first();
		$outlet->nama_outlet = $request->nama_outlet;
		$outlet->save();

        // return $this->response->successResponse('Data kategori berhasil diubah');
        return response()->json([
            'success' => true,
            'message' => 'OK, Kamu berhasil mengupdate data Outletnya:D',
        ]);
    }
    public function delete($id)
    {
        $delete = Outlet::where('id_outlet', $id)->delete();

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data Outletnya:D',
            ]);
                
        } else {
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data Outletnya:D',
            ]);
        }

    }

    public function getAll()
    {
        $data["count"] = Outlet::count();
        $data["outlet"] = Outlet::get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getById($id)
    {   
        $data["outlet"] = Outlet::where('id_outlet', $id)->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

}


