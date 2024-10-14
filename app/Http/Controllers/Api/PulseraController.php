<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PulseraResource;
use App\Http\Requests\StorePulseraRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdatePulseraRequest;

use App\Models\Pulsera;

class PulseraController extends Controller
{
    public function index(){
        return PulseraResource::collection(Pulsera::all());
    }

    public function store(StorePulseraRequest $request){
        $Pulsera = Pulsera::create($request->all());
        $Pulsera->Pulsera()->attach(json_decode($request->etiquetas));
        return response()->json(new PulseraResource($Pulsera),Response::HTTP_CREATED);

    }

    public function show(Pulsera $Pulsera){
        return new PulseraResource($Pulsera);
    }

    public function update(UpdatePulseraRequest $request, Pulsera $Pulsera){
        $Pulsera->update($request->all());

        if($Pulsera = json_decode($request->Pulsera)){
            $Pulsera->Pulsera()->sync($Pulsera);

        }
    }

    public function destroy(Pulsera $Pulsera){

        $Pulsera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
