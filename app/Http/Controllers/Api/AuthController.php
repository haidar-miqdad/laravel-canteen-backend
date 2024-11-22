<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // check if email ada di database
        $user = User::where('email', $request->email)->first(); //mangondi@idn.com

        // kalau ga dapat emailnya bakal di excute yg ini
        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Wrong password breee'
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 200);

    }

    public function logout(Request $request) {

        // delete token, bukan delete user
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);

    }

    public function register(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user,
            'token' => $token
        ], 200);
    }

}
