<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TermoResource;
use App\Http\Requests\StoreTermoRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdateTermoRequest;

use App\Models\Termo;

class TermoController extends Controller
{
    public function index(){
        return TermoResource::collection(Termo::all());
    }

    public function store(StoreTermoRequest $request){
        $Termo = Termo::create($request->all());
        $Termo->etiquetas()->attach(json_decode($request->etiquetas));
        return response()->json(new TermoResource($Termo),Response::HTTP_CREATED);

    }

    public function show(Termo $Termo){
        return new TermoResource($Termo);
    }

    public function update(UpdateTermoRequest $request, Termo $Termo){
        $Termo->update($request->all());

        if($etiquetas = json_decode($request->etiquetas)){
            $Termo->etiquetas()->sync($etiquetas);

        }
    }

    public function destroy(Termo $Termo){

        $Termo->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
