<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PlayeraResource;
use App\Http\Requests\StorePlayeraRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdatePlayeraRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Playera;
use App\Models\Playeras;


class PlayeraController extends Controller
{
    use AuthorizesRequests;
   /**
 * @OA\Get(
 *     path="/api/Playera",
 *     summary="Consultar todas las playera",
 *     description="Retorna todas las playera disponibles",
 *     tags={"Playeras"},
 *     security={{"bearer_token":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="ok",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 type="array",
 *                 property="rows",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="number", example="1"),
 *                     @OA\Property(property="nombre", type="string", example="Playera roja"),
 *                     @OA\Property(property="tamaño", type="string", example="L"),
 *                     @OA\Property(property="color", type="string", example="rojo"),
 *                     @OA\Property(property="precio", type="number", example="15")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function index(){
        $this->authorize(ability: 'ver');
        return PlayeraResource::collection(Playeras::all());
    }
/**
 * Crear una nueva Playera
 * @OA\Post(
 *     path="/api/Playera",
 *     tags={"Playeras"},
 *     summary="Crear una nueva Playera",
 *     description="Crea una nueva Playera en el sistema.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Color", "Tamaño", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Playera Azul"),
 *             @OA\Property(property="Color", type="string", example="Azul"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Playera creada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Playera Azul"),
 *             @OA\Property(property="Color", type="string", example="Azul"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Solicitud incorrecta",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The given data was invalid.")
 *         )
 *     )
 * )
 */

    public function store(StorePlayeraRequest $request){
        $this->authorize('crear');
        
        $Playera = Playeras::create($request->all());
        $Playera->Playera()->attach(json_decode($request->Playera));
        return response()->json(new PlayeraResource($Playera),Response::HTTP_CREATED);

    }

    public function show(Playeras $Playera){
        $this->authorize('ver');
        return new PlayeraResource($Playera);
    }
/**
 * Actualizar una Playera
 * @OA\Put(
 *     path="/api/Playera/{id}",
 *     tags={"Playeras"},
 *     security={{"bearer_token":{}}},
 *     summary="Actualizar una Playera existente",
 *     description="Actualiza los detalles de una Playera con el ID proporcionado.",
 * 
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Color", "Tamaño", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Playera Roja"),
 *             @OA\Property(property="Color", type="string", example="Rojo"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Precio", type="number", format="float", example=20.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Playera actualizada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Playera Roja"),
 *             @OA\Property(property="Color", type="string", example="Rojo"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Precio", type="number", format="float", example=20.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Playera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Playera] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdatePlayeraRequest $request, Playeras $Playera){
        $this->authorize('Actualizar');
        $Playera->update($request->all());

        if($Playera = json_decode($request->Playera)){
            $Playera->Playera()->sync($Playera);

        }
    }
/**
 * Eliminar una Playera
 * @OA\Delete(
 *     path="/api/Playera/{id}",
 *     tags={"Playeras"},
 *     summary="Eliminar una Playera",
 *     description="Elimina una Playera del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Playera eliminada correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Playera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Playera] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Playeras $Playera){
        $this->authorize('Eliminar');
        $Playera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
