<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PlayeraResource;
use App\Http\Requests\StorePlayeraRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdatePlayeraRequest;

use App\Models\Playera;
use App\Models\Playeras;

class PlayeraController extends Controller
{
    public function index(){
        return PlayeraResource::collection(Playeras::all());
    }

    public function store(StorePlayeraRequest $request){
        $Playera = Playeras::create($request->all());
        $Playera->Playera()->attach(json_decode($request->Playera));
        return response()->json(new PlayeraResource($Playera),Response::HTTP_CREATED);

    }

    public function show(Playeras $Playera){
        return new PlayeraResource($Playera);
    }

    public function update(UpdatePlayeraRequest $request, Playeras $Playera){
        $Playera->update($request->all());

        if($Playera = json_decode($request->Playera)){
            $Playera->Playera()->sync($Playera);

        }
    }

    public function destroy(Playeras $Playera){

        $Playera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
