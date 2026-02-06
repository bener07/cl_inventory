<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;
use App\Http\Resources\ItemsResource;
use App\Models\Items;
use App\Models\Place;
use App\ApiResponse;
use Illuminate\Database\QueryException;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Items::query();

        // Total de registos antes de filtros
        $recordsTotal = $query->count();

        // Pesquisa global
        $search = $request->input('search.value');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Total após pesquisa
        $recordsFiltered = $query->count();

        // Ordenação
        $orderColIndex = $request->input('order.0.column', 0); // default primeira coluna
        $orderDir = $request->input('order.0.dir', 'asc');
        $columns = ['id', 'name', 'category', 'price', 'status']; // mapeia para colunas da tabela
        $orderColumn = $columns[$orderColIndex] ?? 'id';
        $query->orderBy($orderColumn, $orderDir);

        // Paginação
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $items = $query->skip($start)->take($length)->get();

        // Formata para DataTables
        $data = ItemsResource::collection($items);

        return ApiResponse::send(true,
            [
                'draw' => intval($request->input('draw', 0)),
                'total' => intval($recordsTotal),
                'filtered' => intval($recordsFiltered),
                'data' => $data
            ], 200, true);
        //return ItemsResource::collection(Items::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemsRequest $request)
    {
        
        $item = Items::create([
            "name" => $request->name,
            "quantity" => $request->quantity,
            "user_id" => auth()->user()->id,
            "notes" => $request->notes ?? null,
            "description" => $request->description ?? null
        ]);
        $place = Place::where('number', $request->place_number)->first();
        $item->places()->attach($place->id);
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
