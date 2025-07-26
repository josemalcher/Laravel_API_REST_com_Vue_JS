<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credecial = $request->only(['email', 'password']);

        if(!auth()->attempt($credecial)) abort(401, 'Invalid credentials');

        return response()->json([
            'data' => [
                'token' => auth()->user()->createToken('default', ['update']),

            ]
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        //auth()->user()->tokens()->where('token', '!=', '')->delete(); // remove todos existentes
        return response()->json([],204);
    }
}
