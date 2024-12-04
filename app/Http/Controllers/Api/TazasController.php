<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TazasResource;
use App\Http\Requests\StoreTazasRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdateTazasRequest;

use App\Models\Taza;

class TazasController extends Controller
{
    public function index(){
        return TazasResource::collection(Taza::all());
    }

    public function store(StoreTazasRequest $request){
        $Tazas = Taza::create($request->all());
        $Tazas->etiquetas()->attach(json_decode($request->Tazas));
        return response()->json(new TazasResource($Tazas),Response::HTTP_CREATED);

    }

    public function show(Taza $Tazas){
        return new TazasResource($Tazas);
    }

    public function update(UpdateTazasRequest $request, Taza $Tazas){
        $Tazas->update($request->all());

        if($etiquetas = json_decode($request->Tazas)){
            $Tazas->Tazas()->sync($Tazas);

        }
    }

    public function destroy(Taza $Tazas){

        $Tazas->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
