<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SudaderaResource;
use App\Http\Requests\StoreSudaderaRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UpdateSudaderaRequest;

use App\Models\Sudadera;

class SudaderaController extends Controller
{
    use AuthorizesRequests;
    /**
 * @OA\Get(
 *     path="/api/Sudadera",
 *     summary="Consultar todas las sudaderas",
 *     description="Retorna todas las sudaderas disponibles",
 *     tags={"Sudaderas"},
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
 *                     @OA\Property(property="nombre", type="string", example="Sudadera gris"),
 *                     @OA\Property(property="tamaño", type="string", example="M"),
 *                     @OA\Property(property="color", type="string", example="gris"),
 *                     @OA\Property(property="precio", type="number", example="30")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function index(){
        $this->authorize('ver');
        return SudaderaResource::collection(Sudadera::all());
    }
/**
 * Crear una nueva Sudadera
 * @OA\Post(
 *     path="/api/Sudadera",
 *     tags={"Sudaderas"},
 *     summary="Crear una nueva Sudadera",
 *     description="Crea una nueva Sudadera en el sistema.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Tamaño", "Color", "Material", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Sudadera con capucha"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Color", type="string", example="Rojo"),
 *             @OA\Property(property="Material", type="string", example="Algodón"),
 *             @OA\Property(property="Precio", type="number", format="float", example=45.99),
 *             @OA\Property(property="Stock", type="integer", example=30)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Sudadera creada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Sudadera con capucha"),
 *             @OA\Property(property="Tamaño", type="string", example="L"),
 *             @OA\Property(property="Color", type="string", example="Rojo"),
 *             @OA\Property(property="Material", type="string", example="Algodón"),
 *             @OA\Property(property="Precio", type="number", format="float", example=45.99),
 *             @OA\Property(property="Stock", type="integer", example=30)
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

    public function store(StoreSudaderaRequest $request){
        $this->authorize('Crear');
        $Sudadera = Sudadera::create($request->all());
        $Sudadera->Sudadera()->attach(json_decode($request->Suaderas));
        return response()->json(new SudaderaResource($Sudadera),Response::HTTP_CREATED);

    }

    public function show(Sudadera $Sudadera){
        $this->authorize('ver');
        return new SudaderaResource($Sudadera);
    }
/**
 * Actualizar una Sudadera
 * @OA\Put(
 *     path="/api/Sudadera/{id}",
 *     tags={"Sudaderas"},
 *     summary="Actualizar una Sudadera existente",
 *     description="Actualiza los detalles de una Sudadera con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Tamaño", "Color", "Material", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Sudadera con capucha gris"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Color", type="string", example="Gris"),
 *             @OA\Property(property="Material", type="string", example="Algodón"),
 *             @OA\Property(property="Precio", type="number", format="float", example=49.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Sudadera actualizada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Sudadera con capucha gris"),
 *             @OA\Property(property="Tamaño", type="string", example="M"),
 *             @OA\Property(property="Color", type="string", example="Gris"),
 *             @OA\Property(property="Material", type="string", example="Algodón"),
 *             @OA\Property(property="Precio", type="number", format="float", example=49.99),
 *             @OA\Property(property="Stock", type="integer", example=50)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Sudadera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Sudadera] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdateSudaderaRequest $request, Sudadera $Sudadera){
        $this->authorize('Actualizar');
        $Sudadera->update($request->all());

        if($Sudadera = json_decode($request->Sudadera)){
            $Sudadera->Playera()->sync($Sudadera);

        }
    }
/**
 * Eliminar una Sudadera
 * @OA\Delete(
 *     path="/api/Sudadera/{id}",
 *     tags={"Sudaderas"},
 *     summary="Eliminar una Sudadera",
 *     description="Elimina una Sudadera del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Sudadera eliminada correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró la Sudadera",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Sudadera] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Sudadera $Sudadera){
        $this->authorize('Eliminar');

        $Sudadera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
