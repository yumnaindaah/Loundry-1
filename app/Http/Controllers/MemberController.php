<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//yang ditambahkan
use Illuminate\Support\Facades\Validator;
use App\Models\Member;

class MemberController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
			'nama_member'   => 'required|string',
            'alamat_member' => 'required|string',
            'jenis_kelamin' => 'required',
            'telp_member'   => 'required|numeric'
            //kolom di postman
		]);

        if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$member = new Member();
		$member->nama           = $request->nama_member;
        $member->alamat         = $request->alamat_member;
        $member->jenis_kelamin  = $request->jenis_kelamin;
        $member->telp           = $request->telp_member;
        // kolom di database             kolom di postman   
		$member->save();

        $data = Member::where('id_member','=', $member->id_member)->first();
        // return $this->response->successResponseData('Data kategori berhasil ditambahkan', $data);

        return response()->json([
            'success' => true,
            'message' => 'Yeay, Kamu berhasil menambahkan member baru:D',
            'data'    => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'nama_member'   => 'required|string',
            'alamat_member' => 'required|string',
            'jenis_kelamin' => 'required',
            'telp_member'   => 'required|string'
            //kolom di postman
		]);

		if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$member = Member::where('id_member', $id)->first();
		$member->nama           = $request->nama_member;
        $member->alamat         = $request->alamat_member;
        $member->jenis_kelamin  = $request->jenis_kelamin;
        $member->telp           = $request->telp_member;
        // kolom di database             kolom di postman 
		$member->save();

        // return $this->response->successResponse('Data kategori berhasil diubah');
        return response()->json([
            'success' => true,
            'message' => 'OK, Kamu berhasil mengupdate data membernya:D',
        ]);
    }
    public function delete($id)
    {
        $delete = Member::where('id_member', $id)->delete();

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data membernya:D',
            ]);
                
        } else {
            return response()->json([
                'success' => true,
                'message' => 'OK, Kamu berhasil menghapus data membernya:D',
            ]);
        }

    }

    public function getAll()
    {
        $data["count"] = Member::count();
        $data["member"] = Member::get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }

    public function getById($id)
    {   
        $data["member"] = Member::where('id_member', $id)->get();

        return response()->json([
            'success' => true,
            'data'    => $data
        ]);
    }
}

