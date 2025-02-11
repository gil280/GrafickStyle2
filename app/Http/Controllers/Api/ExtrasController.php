<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ExtrasResource;
use App\Http\Requests\StoreExtrasRequest;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests\UpdateExtrasRequest;


use App\Models\Extras;


class ExtrasController extends Controller

{
    use AuthorizesRequests;
/**
     * extras
     * @OA\Get (
     *     path="/api/Extras",
     *     tags={"Extras"},
     *     @OA\Response(
     *         response=200,
     *         description="ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 type="array",
     *                 property="rows",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="Logotipos",
     *                         type="string",
     *                         example="logo1"
     *                     ),
     *                     @OA\Property(
     *                         property="Imagenes editadas",
     *                         type="string",
     *                         example="img1"
     *                     ),
     *                     @OA\Property(
     *                         property="Cantidad",
     *                         type="unsignedInteger",
     *                         example="1"
     *                     ),
     *                     @OA\Property(
     *                         property="Fecha de entrega",
     *                         type="datetime",
     *                         example="2023-02-23T12:33:45.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="Precio",
     *                         type="number",
     *                         example="10.5"
     *                     )
     *                 )
     *             )
     *         )
     *     )
     * )
     */

    public function index(){
        $this->authorize('ver');
        return ExtrasResource::collection(Extras::all());
    }

    public function store(StoreExtrasRequest $request){
        $this->authorize('crear');
        $Extras = Extras::create($request->all());
        $Extras->Extras()->attach(json_decode($request->Extras));
        return response()->json(new ExtrasResource($Extras),Response::HTTP_CREATED);

    }
 /**
 * Mostrar la información de un Extra
 * @OA\Get (
 *     path="/api/Extras/{id}",
 *     tags={"Extras"},
 *     summary="Obtener un Extra específico",
 *     description="Retorna los detalles de un Extra con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Logotipos", type="string", example="Logo1"),
 *             @OA\Property(property="Imagenes editadas", type="string", example="img1"),
 *             @OA\Property(property="Cantidad", type="integer", example=2),
 *             @OA\Property(property="Fecha de entrega", type="string", format="date-time", example="2023-02-23T12:33:45.000000Z"),
 *             @OA\Property(property="Precio", type="number", format="float", example=10.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró el Extra",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Extras] #id")
 *         )
 *     )
 * )
 */

    public function show(Extras $Extras){
        $this->authorize('ver');
        return new ExtrasResource($Extras);
        
    }
/**
 * Actualizar un Extra
 * @OA\Put(
 *     path="/api/Extras/{id}",
 *     tags={"Extras"},
 *     summary="Actualizar un Extra existente",
 *     description="Actualiza los detalles de un Extra con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Logotipos", "Imagenes editadas", "Cantidad", "Fecha de entrega", "Precio"},
 *             @OA\Property(property="Logotipos", type="string", example="Logo1"),
 *             @OA\Property(property="Imagenes editadas", type="string", example="img1"),
 *             @OA\Property(property="Cantidad", type="integer", example=3),
 *             @OA\Property(property="Fecha de entrega", type="string", format="date-time", example="2023-02-23T12:33:45.000000Z"),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Extra actualizado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Logotipos", type="string", example="Logo1"),
 *             @OA\Property(property="Imagenes editadas", type="string", example="img1"),
 *             @OA\Property(property="Cantidad", type="integer", example=3),
 *             @OA\Property(property="Fecha de entrega", type="string", format="date-time", example="2023-02-23T12:33:45.000000Z"),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.5)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró el Extra",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Extras] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdateExtrasRequest $request, Extras $Extras){
        $this->authorize('Actualizar');
        $Extras->update($request->all());

        if($Extras = json_decode($request->Extras)){
            $Extras->Extras()->sync($Extras);

        }
    }

/**
 * Eliminar un Extra
 * @OA\Delete(
 *     path="/api/Extras/{id}",
 *     tags={"Extras"},
 *     summary="Eliminar un Extra",
 *     description="Elimina un Extra del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Extra eliminado correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró el Extra",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Extras] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Extras $Extras){
        $this->authorize('Eliminar');

        $Extras->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
