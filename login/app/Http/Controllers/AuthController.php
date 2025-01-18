<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
public function register(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 400);
        }

        User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message'=>'Usuario registrado correctamente'], 200);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = JWTAuth::fromUser($user);
            return response()->json(['message' => 'Inicio de sesión exitoso', 'token' => $token]);

        }
        return response()->json(['message'=> 'Credenciales inválidas'], 401);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }

public function logout(Request $request)
{
    JWTAuth::invalidate(JWTAuth::getToken());
    return response()->json(['message' => 'Sesión cerrada con éxito']);
}

}
