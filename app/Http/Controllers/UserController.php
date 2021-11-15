<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller 
{
    public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id_outlet' => 'required|string|max:20',
			'nama' => 'required|string|max:255',
			'username' => 'required|string|max:50|unique:Users', 
            // unique:Users digunakan untuk mengecek apakah ada username yang sama atau tidak
			'password' => 'required|string|min:6',
			// 'role' => 'required|string',
		]);

		if($validator->fails()){
            // return $this->response->errorResponse($validator->errors());
            return response()->json([
                'success' => 'false',
                'message' => $validator->errors(),
            ]);
		}

		$user = new User();
		$user->id_outlet 	= $request->id_outlet;
		$user->nama 	    = $request->nama;
		$user->username     = $request->username;
		$user->role         = $request->role;
        // di api_pengaduan role setara dengan level, hanya beda nama
		$user->password     = Hash::make($request->password);
		$user->save();

		// $token = JWTAuth::fromUser($user);

        $data = User::where('username','=', $request->username)->first();
        // return $this->response->successResponseData('Data masyarakat berhasil ditambahkan', $data);
        
        return response()->json([
            'success' => true,
            'message' => 'Yeay, Kamu berhasil menambahkan admin baru:D',
            'data'    => $data
        ]);
	}
    public function login(Request $request){
		$credentials = $request->only('username', 'password');

		try {
			if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Invalid username and password:(',
                ]);

            }

        } catch(JWTException $e){
            return response()->json([
                'success'=> false,
                'message'=> 'Generate token failed:(',
            ]);
		}

        $data = [
			'token' => $token,
			'user'  => JWTAuth::user()
		];
        return response()->json([
            'success'=> true,
            'message'=> 'Yeay, Kamu berhasil masuk:)',
            'data'   => $data
        ]);
	}
}

