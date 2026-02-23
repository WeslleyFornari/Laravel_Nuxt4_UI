<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Ei, você esqueceu o e-mail!',
            'password.required' => 'A senha é obrigatória.'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return response()->json([
                'message' => 'Login realizado com sucesso!',
                'user' => Auth::user()

            ], 200);
        }

        return response()->json([
            'message' => ['As credenciais fornecidas estão incorretas.'],
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(Request $request)
{
    // Faz o logout do guarda padrão
    Auth::guard('web')->logout();

    // Invalida a sessão do usuário no servidor
    $request->session()->invalidate();

    // Regenera o token CSRF para segurança
    $request->session()->regenerateToken();

    return response()->json(['message' => 'Logged out successfully']);
}
}
