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

class ExtrasController extends Controller

{
    use AuthorizesRequests;
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
