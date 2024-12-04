<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
            'dispositivo' => 'required'
        ]);

        $user = User::where('email', $request->correo)->first();

        if(!$user || !Hash::check($request->contraseña, $user->password)){
            return response()->json([
                'message' => 'Las credenciales no coinciden con nuestros registros'
            ], Response::HTTP_UNPROCESSABLE_ENTITY); //422
        }

        return response()->json([
            'data' => [
                'atributos' => [
                    'id' => $user->id,
                    'nombre' => $user->name,
                    'correo' => $user->email,
                ],
            'token' => $user->createToken($request->dispositivo)->plainTextToken,
            ],
        ], Response::HTTP_OK); //200

    }
}