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
    public function index(){
        $this->authorize('ver');
        return TermoResource::collection(Termo::all());
    }

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

    public function update(UpdateTermoRequest $request, Termo $Termo){
        $this->authorize('Actualizar');
        $Termo->update($request->all());

        if($Termo = json_decode($request->Termo)){
            $Termo->Tazas()->sync($Termo);

        }
    }

    public function destroy(Termo $Termo){
        $this->authorize('Eliminar');

        $Termo->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
