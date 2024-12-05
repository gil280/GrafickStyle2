<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PulseraResource;
use App\Http\Requests\StorePulseraRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests\UpdatePulseraRequest;

use App\Models\Pulsera;

class PulseraController extends Controller
{
    use AuthorizesRequests;
    public function index(){
        $this->authorize('ver');
        return PulseraResource::collection(Pulsera::all());
    }

    public function store(StorePulseraRequest $request){
        $Pulsera = Pulsera::create($request->all());
        $Pulsera->Pulsera()->attach(json_decode($request->etiquetas));
        return response()->json(new PulseraResource($Pulsera),Response::HTTP_CREATED);

    }

    public function show(Pulsera $Pulsera){
        $this->authorize('ver');
        return new PulseraResource($Pulsera);
    }

    public function update(UpdatePulseraRequest $request, Pulsera $Pulsera){
        $this->authorize('Actualizar');
        $Pulsera->update($request->all());

        if($Pulsera = json_decode($request->Pulsera)){
            $Pulsera->Pulsera()->sync($Pulsera);

        }
    }

    public function destroy(Pulsera $Pulsera){
        $this->authorize('Eliminar');

        $Pulsera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
