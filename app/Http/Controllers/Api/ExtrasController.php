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

/**
* @OA\Info(
*             title="API Extras", 
*             version="1.0",
*             description="Listado de los productos extras"
* )
*
* @OA\Server(url="http://127.0.0.1:8000")
*/

class ExtrasController extends Controller

{
    use AuthorizesRequests;
/**
     * @OA\Get(
     *    path="/api/Extras",
     *    summary="Consultar todos los extras",
     *    description="Retorna todas las recetas",
     *    tags={"Extras"},
     *    security={{"bearer_token":{}}},
     *    @OA\Response(
     *       response=200,
     *      description="Operación exitosa",
     *   ),
     *   @OA\Response(
     *     response=403,
     *     description="No autorizado"
     *   ),
     *   @OA\Response(
     *     response=404,
     *     description="No se encontraron recetas"
     *   ),
     *   @OA\Response(
     *    response=405,
     *    description="Método no permitido"
     *   )
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

    public function show(Extras $Extras){
        $this->authorize('ver');
        return new ExtrasResource($Extras);
        
    }

    public function update(UpdateExtrasRequest $request, Extras $Extras){
        $this->authorize('Actualizar');
        $Extras->update($request->all());

        if($Extras = json_decode($request->Extras)){
            $Extras->Extras()->sync($Extras);

        }
    }

    public function destroy(Extras $Extras){
        $this->authorize('Eliminar');

        $Extras->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
