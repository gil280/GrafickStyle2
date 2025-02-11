<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TazasResource;
use App\Http\Requests\StoreTazasRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UpdateTazasRequest;

use App\Models\Taza;

class TazasController extends Controller
{
    use AuthorizesRequests;
    /**
 * @OA\Get(
 *     path="/api/Taza",
 *     summary="Consultar todas las tazas",
 *     description="Retorna todas las tazas disponibles",
 *     tags={"Tazas"},
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
 *                     @OA\Property(property="nombre", type="string", example="Taza blanca"),
 *                     @OA\Property(property="material", type="string", example="cerámica"),
 *                     @OA\Property(property="capacidad", type="string", example="350 ml"),
 *                     @OA\Property(property="precio", type="number", example="8")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function index(){
        $this->authorize('ver');
        return TazasResource::collection(Taza::all());
    }
/**
 * Crear una nueva Taza
 * @OA\Post(
 *     path="/api/Taza/{Taza}",
 *     tags={"Tazas"},
 *     summary="Crear una nueva Taza",
 *     description="Crea una nueva Taza en el sistema.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Color", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Taza de cerámica"),
 *             @OA\Property(property="Material", type="string", example="Cerámica"),
 *             @OA\Property(property="Color", type="string", example="Blanco"),
 *             @OA\Property(property="Precio", type="number", format="float", example=12.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Taza creada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Taza de cerámica"),
 *             @OA\Property(property="Material", type="string", example="Cerámica"),
 *             @OA\Property(property="Color", type="string", example="Blanco"),
 *             @OA\Property(property="Precio", type="number", format="float", example=12.99),
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

    public function store(StoreTazasRequest $request){
        $this->authorize('Crear');
        $Tazas = Taza::create($request->all());
        $Tazas->etiquetas()->attach(json_decode($request->Tazas));
        return response()->json(new TazasResource($Tazas),Response::HTTP_CREATED);

    }

    public function show(Taza $Tazas){
        $this->authorize('ver');
        return new TazasResource($Tazas);
    }
/**
 * Actualizar una Taza
 * @OA\Put(
 *     path="/api/Taza/{Taza}",
 *     tags={"Tazas"},
 *     summary="Actualizar una Taza existente",
 *     description="Actualiza los detalles de una Taza con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Color", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Taza de cerámica negra"),
 *             @OA\Property(property="Material", type="string", example="Cerámica"),
 *             @OA\Property(property="Color", type="string", example="Negro"),
 *             @OA\Property(property="Precio", type="number", format="float", example=14.99),
 *             @OA\Property(property="Stock", type="integer", example=150)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Taza actualizada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Taza de cerámica negra"),
 *             @OA\Property(property="Material", type="string", example="Cerámica"),
 *             @OA\Property(property="Color", type="string", example="Negro"),
 *             @OA\Property(property="Precio", type="number", format="float", example=14.99),
 *             @OA\Property(property="Stock", type="integer", example=150)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Taza",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Taza] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdateTazasRequest $request, Taza $Tazas){
        $this->authorize('Actualizar');
        $Tazas->update($request->all());

        if($etiquetas = json_decode($request->Tazas)){
            $Tazas->Tazas()->sync($Tazas);

        }
    }
/**
 * Eliminar una Taza
 * @OA\Delete(
 *     path="/api/Taza/{Taza} ",
 *     tags={"Tazas"},
 *     summary="Eliminar una Taza",
 *     description="Elimina una Taza del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Taza eliminada correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Taza",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Taza] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Taza $Tazas){
        $this->authorize('Eliminar');

        $Tazas->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
