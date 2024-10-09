<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
     public function register(Request $request){

         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|min:6|confirmed',
            'mobile_no' => 'required|string|max:255',
         ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => "Validation Error",
                'errors' => $validator->errors()->all(),
            ], 401);
        }
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
        ]);

        $token = $client->createToken('auth_token')->plainTextToken;

        $client->token = $token;
        $client->save();

        return response()->json([
            'success' => true, 
            'message' => 'Client registered successfully',
            'data' => $client,
            'access_token' => $token,
        ], 200);
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => "Authentication Fails",
                'errors' => $validator->errors()->all(),
            ], 401);
        }

        $client = Client::where('email', $request->email)->first();

        if (! $client || ! Hash::check($request->password, $client->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $client->createToken('auth_token')->plainTextToken;

        $client->token = $token;
        $client->save();

        return response()->json([
            'success' => true,
            'message' => 'Client logged in successfully',
            'token' => $token,
            "token_type" =>'bearer',
        ],200);
    }
}
