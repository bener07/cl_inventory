<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Place;
use App\Http\Resources\PlacesResource;
use App\ApiResponse;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApiResponse::send(true, PlacesResource::collection(Place::all()), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->toArray());
        return ApiResponse::send(true, new PlacesResource($place), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        return ApiResponse::send(true, new PlacesResources($place), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->toArray());
        return ApiResponse::send(true, new PlacesResource($place), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        $place->destroy();
    }
}
