<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PulseraResource;
use App\Http\Requests\StorePulseraRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests\UpdatePulseraRequest;

use App\Models\Pulsera;

class PulseraController extends Controller
{
    use AuthorizesRequests;
    /**
 * @OA\Get(
 *     path="/api/Pulsera",
 *     summary="Consultar todas las pulseras",
 *     description="Retorna todas las pulseras disponibles",
 *     tags={"Pulseras"},
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
 *                     @OA\Property(property="nombre", type="string", example="Pulsera de cuero"),
 *                     @OA\Property(property="color", type="string", example="negro"),
 *                     @OA\Property(property="precio", type="number", example="20")
 *                 )
 *             )
 *         )
 *     )
 * )
 */

    public function index(){
        $this->authorize('ver');
        return PulseraResource::collection(Pulsera::all());
    }
/**
 * Crear una nueva Pulsera
 * @OA\Post(
 *     path="/api/Pulsera",
 *     tags={"Pulseras"},
 *     summary="Crear una nueva Pulsera",
 *     description="Crea una nueva Pulsera en el sistema.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Tamaño", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Pulsera de cuero"),
 *             @OA\Property(property="Material", type="string", example="Cuero"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Precio", type="number", format="float", example=25.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pulsera creada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Pulsera de cuero"),
 *             @OA\Property(property="Material", type="string", example="Cuero"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Precio", type="number", format="float", example=25.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
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

    public function store(StorePulseraRequest $request){
        $Pulsera = Pulsera::create($request->all());
        $Pulsera->Pulsera()->attach(json_decode($request->etiquetas));
        return response()->json(new PulseraResource($Pulsera),Response::HTTP_CREATED);

    }

    public function show(Pulsera $Pulsera){
        $this->authorize('ver');
        return new PulseraResource($Pulsera);
    }
/**
 * Actualizar una Pulsera
 * @OA\Put(
 *     path="/api/Pulsera/{id}",
 *     tags={"Pulseras"},
 *     summary="Actualizar una Pulsera existente",
 *     description="Actualiza los detalles de una Pulsera con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Tamaño", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Pulsera de plata"),
 *             @OA\Property(property="Material", type="string", example="Plata"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Precio", type="number", format="float", example=30.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pulsera actualizada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Pulsera de plata"),
 *             @OA\Property(property="Material", type="string", example="Plata"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Precio", type="number", format="float", example=30.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Pulsera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Pulsera] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdatePulseraRequest $request, Pulsera $Pulsera){
        $this->authorize('Actualizar');
        $Pulsera->update($request->all());

        if($Pulsera = json_decode($request->Pulsera)){
            $Pulsera->Pulsera()->sync($Pulsera);

        }
    }
/**
 * Eliminar una Pulsera
 * @OA\Delete(
 *     path="/api/Pulsera/{id}",
 *     tags={"Pulseras"},
 *     summary="Eliminar una Pulsera",
 *     description="Elimina una Pulsera del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Pulsera eliminada correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Pulsera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Pulsera] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Pulsera $Pulsera){
        $this->authorize('Eliminar');

        $Pulsera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
