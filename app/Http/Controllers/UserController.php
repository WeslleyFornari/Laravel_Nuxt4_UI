<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $search = $request->query('search');
        $users = User::paginate(20);
        // $query = User::query();

        // Se houver busca, aplica o filtro
        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('name', 'like', "%{$search}%")
        //             ->orWhere('email', 'like', "%{$search}%")
        //             ->orWhere('id', 'like', "%{$search}%");
        //     });
        // }

        // $users = $query->orderBy('created_at', 'desc')
        //     ->paginate(20);

        return response()->json([
            'data' => $users,
            'message' => 'Usuários carregados com sucesso!',
            'status' => 'success'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function signup(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user['password'] = bcrypt($user['password']);

        User::create($user);

        return response()->json([
            'message' => 'Usuario registrado com sucesso!'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return response()->json($request->all());
        $user = $request->all();
        $user['password'] = Hash::make(Str::random(12));

        User::create($user);
        return response()->json([
            'message' => 'Usuario cadastrado com sucesso!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buscar()
    {
        $search = request('sear');
        $results = [
            'users' => User::with('post')->where('name', 'like', "%$search%")->get(),
            'posts' => Post::where('title', 'like', "%$search%")->get(),
        ];

        return response()->json($results);
    }
}
