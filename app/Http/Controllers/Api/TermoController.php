<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TermoResource;
use App\Http\Requests\StoreTermoRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UpdateTermoRequest;

use App\Models\Termo;

class TermoController extends Controller
{
    use AuthorizesRequests;
    /**
 * @OA\Get(
 *     path="/api/Termo",
 *     summary="Consultar todos los termos",
 *     description="Retorna todos los termos disponibles",
 *     tags={"Termos"},
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
 *                     @OA\Property(property="nombre", type="string", example="Termo térmico"),
 *                     @OA\Property(property="capacidad", type="string", example="500 ml"),
 *                     @OA\Property(property="material", type="string", example="acero inoxidable"),
 *                     @OA\Property(property="precio", type="number", example="25")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
    public function index(){
        $this->authorize('ver');
        return TermoResource::collection(Termo::all());
    }
/**
 * Crear un nuevo Termo
 * @OA\Post(
 *     path="/api/Termo",
 *     tags={"Termos"},
 *     summary="Crear un nuevo Termo",
 *     description="Crea un nuevo Termo en el sistema.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Capacidad", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Termo de acero inoxidable"),
 *             @OA\Property(property="Material", type="string", example="Acero inoxidable"),
 *             @OA\Property(property="Capacidad", type="integer", example=500),
 *             @OA\Property(property="Precio", type="number", format="float", example=25.50),
 *             @OA\Property(property="Stock", type="integer", example=200)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Termo creado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Termo de acero inoxidable"),
 *             @OA\Property(property="Material", type="string", example="Acero inoxidable"),
 *             @OA\Property(property="Capacidad", type="integer", example=500),
 *             @OA\Property(property="Precio", type="number", format="float", example=25.50),
 *             @OA\Property(property="Stock", type="integer", example=200)
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

    public function store(StoreTermoRequest $request){
        $this->authorize('Crear');
        $Termo = Termo::create($request->all());
        $Termo->termo()->attach(json_decode($request->etiquetas));
        return response()->json(new TermoResource($Termo),Response::HTTP_CREATED);

    }

    public function show(Termo $Termo){
        $this->authorize('ver');
        return new TermoResource($Termo);
    }
/**
 * Actualizar un Termo
 * @OA\Put(
 *     path="/api/Termo/{id}",
 *     tags={"Termos"},
 *     summary="Actualizar un Termo existente",
 *     description="Actualiza los detalles de un Termo con el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"Nombre", "Material", "Capacidad", "Precio", "Stock"},
 *             @OA\Property(property="Nombre", type="string", example="Termo de plástico"),
 *             @OA\Property(property="Material", type="string", example="Plástico"),
 *             @OA\Property(property="Capacidad", type="integer", example=750),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Termo actualizado correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="Nombre", type="string", example="Termo de plástico"),
 *             @OA\Property(property="Material", type="string", example="Plástico"),
 *             @OA\Property(property="Capacidad", type="integer", example=750),
 *             @OA\Property(property="Precio", type="number", format="float", example=15.99),
 *             @OA\Property(property="Stock", type="integer", example=100)
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró el Termo",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Termo] #id")
 *         )
 *     )
 * )
 */

    public function update(UpdateTermoRequest $request, Termo $Termo){
        $this->authorize('Actualizar');
        $Termo->update($request->all());

        if($Termo = json_decode($request->Termo)){
            $Termo->Tazas()->sync($Termo);

        }
    }
/**
 * Eliminar un Termo
 * @OA\Delete(
 *     path="/api/Termo/{id}",
 *     tags={"Termos"},
 *     summary="Eliminar un Termo",
 *     description="Elimina un Termo del sistema usando el ID proporcionado.",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Termo eliminado correctamente"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No se encontró el Termo",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Termo] #id")
 *         )
 *     )
 * )
 */

    public function destroy(Termo $Termo){
        $this->authorize('Eliminar');

        $Termo->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
