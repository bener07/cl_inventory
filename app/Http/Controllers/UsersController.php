<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use App\Http\Resources\UsersResource;
use App\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Total de registos antes de filtros
        $recordsTotal = $query->count();

        // Pesquisa global
        $search = $request->input('search.value');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Total após pesquisa
        $recordsFiltered = $query->count();

        // Ordenação
        $orderColIndex = $request->input('order.0.column', 0); // default primeira coluna
        $orderDir = $request->input('order.0.dir', 'asc');
        $columns = ['id', 'name', 'email']; // colunas do modelo Place
        $orderColumn = $columns[$orderColIndex] ?? 'id';
        $query->orderBy($orderColumn, $orderDir);

        // Paginação
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $places = $query->skip($start)->take($length)->get();

        // Formata para DataTables
        $data = UsersResource::collection($places);

        return ApiResponse::send(true,
            [
                'draw' => intval($request->input('draw', 0)),
                'total' => intval($recordsTotal),
                'filtered' => intval($recordsFiltered),
                'data' => $data
            ], 200, true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->_token);
        $user->save();
        dd($user);
        return ApiResponse::send(true, new UsersResource($user), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsersRequest $request, User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->id == auth()->user->id){
            return ApiResponse::send(true, "Come on! Don't delete your own account this way!", 600);
        }
        $user->destroy();
    }
}
