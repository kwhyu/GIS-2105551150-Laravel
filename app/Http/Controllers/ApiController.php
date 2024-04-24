<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use App\Models\Data;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Something error', 'data' => ['errors' => $validator->messages()]], 200);
        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid login credentials.',
                ], 400);
            }
        } catch (JWTException $e) {
            //return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        //$user = JWTAuth::authenticate("Bearer $token");
        $user = JWTAuth::user()->only('id', 'email', 'name');
        //Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => ['token' => $token, 'user' => $user],
        ]);
    }

    public function logout(Request $request)
    {
        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->header()['authorization']);

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);
        return response()->json([
            'success' => true,
            'message' => 'Successfully get user info',
            'data' => ['user' => $user, 'expired' => JWTAuth::getPayload($request->token)->toArray()['exp'] - time() . ' second(s)'],
            //'token' => $request->header()['authorization'],
            //'tokeninfo' => JWTAuth::getPayload($request->token)->toArray(),
            //'now' => time(),
            //'expired' => JWTAuth::getPayload($request->token)->toArray()['exp'] - time() . ' second(s)',
        ], 200);
    }
///////////////////////////////////////
    public function addData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_rs' => 'required|string',
            'latlng_rs' => 'required|string',
            'tipe_rs' => 'required|string',
            'gambar_rs' => 'required|image',
            'alamat_rs' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        $rs = Data::create([
            'nama_rs' => $request->nama_rs,
            'latlng_rs' => $request->latlng_rs,
            'tipe_rs' => $request->tipe_rs,
            'gambar_rs' => $request->gambar_rs,
            'alamat_rs' => $request->alamat_rs,


        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rumah Sakit berhasil ditambahkan',
            'data' => $rs
        ], Response::HTTP_CREATED);
    }

    public function getData(Request $request)
    {
        $rs = Data::all();

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $rs
        ], Response::HTTP_OK);
    }


}
