<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Iniciar sesión y obtener token",
     *     description="Recibe correo, contraseña y nombre de dispositivo. Devuelve token para Authorization Bearer.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="correo", type="string", format="email", example="garciareyesgildardo@gmail.com"),
     *                 @OA\Property(property="contraseña", type="string", format="password", example="password"),
     *                 @OA\Property(property="dispositivo", type="string", example="web"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inicio de sesión correcto",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="atributos", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="nombre", type="string", example="Juan"),
     *                     @OA\Property(property="correo", type="string", example="usuario@ejemplo.com"),
     *                 ),
     *                 @OA\Property(property="token", type="string", example="<token_aqui>"),
     *             )
     *         )
     *     ),
     *     @OA\Response(response=422, description="Credenciales inválidas")
     * )
     */
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