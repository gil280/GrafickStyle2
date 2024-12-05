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
    public function index(){
        $this->authorize('ver');
        return TazasResource::collection(Taza::all());
    }

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

    public function update(UpdateTazasRequest $request, Taza $Tazas){
        $this->authorize('Actualizar');
        $Tazas->update($request->all());

        if($etiquetas = json_decode($request->Tazas)){
            $Tazas->Tazas()->sync($Tazas);

        }
    }

    public function destroy(Taza $Tazas){
        $this->authorize('Eliminar');

        $Tazas->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
