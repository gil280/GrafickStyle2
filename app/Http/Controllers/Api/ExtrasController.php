<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\ExtrasResource;
use App\Http\Requests\StoreExtrasRequest;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UpdateExtrasRequest;

use App\Models\Extras;

class ExtrasController extends Controller
{
    public function index(){
        return ExtrasResource::collection(Extras::all());
    }

    public function store(StoreExtrasRequest $request){
        $Extras = Extras::create($request->all());
        $Extras->Extras()->attach(json_decode($request->Extras));
        return response()->json(new ExtrasResource($Extras),Response::HTTP_CREATED);

    }

    public function show(Extras $Extras){
        return new ExtrasResource($Extras);
    }

    public function update(UpdateExtrasRequest $request, Extras $Extras){
        $Extras->update($request->all());

        if($Extras = json_decode($request->Extras)){
            $Extras->Extras()->sync($Extras);

        }
    }

    public function destroy(Extras $Extras){

        $Extras->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT); // 204 
    }

}
