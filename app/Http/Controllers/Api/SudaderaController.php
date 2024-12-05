<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SudaderaResource;
use App\Http\Requests\StoreSudaderaRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UpdateSudaderaRequest;

use App\Models\Sudadera;

class SudaderaController extends Controller
{
    use AuthorizesRequests;
    public function index(){
        $this->authorize('ver');
        return SudaderaResource::collection(Sudadera::all());
    }

    public function store(StoreSudaderaRequest $request){
        $this->authorize('Crear');
        $Sudadera = Sudadera::create($request->all());
        $Sudadera->Sudadera()->attach(json_decode($request->Suaderas));
        return response()->json(new SudaderaResource($Sudadera),Response::HTTP_CREATED);

    }

    public function show(Sudadera $Sudadera){
        $this->authorize('ver');
        return new SudaderaResource($Sudadera);
    }

    public function update(UpdateSudaderaRequest $request, Sudadera $Sudadera){
        $this->authorize('Actualizar');
        $Sudadera->update($request->all());

        if($Sudadera = json_decode($request->Sudadera)){
            $Sudadera->Playera()->sync($Sudadera);

        }
    }

    public function destroy(Sudadera $Sudadera){
        $this->authorize('Eliminar');

        $Sudadera->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
