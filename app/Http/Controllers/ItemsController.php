<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Http\Resources\ItemsResource;
use App\Models\Items;
use App\ApiResponse;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ItemsResource::collection(Items::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemsRequest $request)
    {
        
        $item = Items::create([
            "name" => $request->name,
            "quantity" => $request->quantity,
            "user_id" => $request->user_id,
            "notes" => $request->notes ?? null,
            "description" => $request->description ?? null
        ]);
        return ApiResponse::send(true, new ItemsResource($item), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Items $item)
    {
        return ApiResponse::send(true, $item, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemsRequest $request, Items $item)
    {
        $item->update($request->toArray());

        return ApiResponse::send(true, new ItemsResource($item), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $item)
    {
        $item->destroy($item->id);
        return ApiResponse::send(true, "Successfuly deleted!", 200);
    }
}
