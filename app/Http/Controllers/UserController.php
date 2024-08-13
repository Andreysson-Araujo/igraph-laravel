<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validatedData= $request->validate([
            'name'=> 'required|string|max:255',
            'username'=>'required|string|max:255',
            'status'=>'required|boolean',
            'email'=>'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Validação da senha
            'nivel' => 'required|boolean', // Validação do nível
            'last_access' => 'nullable|date', // Data e hora do último acesso
        ]);

        $existingUser = User::where('username', $validatedData['username'])->first();

        if($existingUser) {
            return response()->json([
                'message'=> 'Usuario ja existe.'
            ], Response::HTTP_FORBIDDEN);
        }

        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    public function show(string $id)
    {
        return User::findOrFail($id);
    }
    public function update(Request $request, string $id)
    {
        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
            'username'=>'required|string:max:255',
            'status'=>'required|boolean',
            'email'=>'required|string|max:255',
            'password'=>'required|string|min:8|confirmed',
            'nivel'=>'required|boolean',
            'last_access'=> 'nullable|date',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);
        return response()->json($user, 200);
    }

    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();
    }
}
