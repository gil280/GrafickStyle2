<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PlayeraResource;
use App\Http\Requests\StorePlayeraRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdatePlayeraRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Playera;
use App\Models\Playeras;

class PlayeraController extends Controller
{
    use AuthorizesRequests;
    public function index(){
        $this->authorize('ver');
        return PlayeraResource::collection(Playeras::all());
    }

    public function store(StorePlayeraRequest $request){
        $this->authorize('crear');
        
        $Playera = Playeras::create($request->all());
        $Playera->Playera()->attach(json_decode($request->Playera));
        return response()->json(new PlayeraResource($Playera),Response::HTTP_CREATED);

    }

    public function show(Playeras $Playera){
        $this->authorize('ver');
        return new PlayeraResource($Playera);
    }

    public function update(UpdatePlayeraRequest $request, Playeras $Playera){
        $this->authorize('Actualizar');
        $Playera->update($request->all());

        if($Playera = json_decode($request->Playera)){
            $Playera->Playera()->sync($Playera);

        }
    }

    public function destroy(Playeras $Playera){
        $this->authorize('Eliminar');
        $Playera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
