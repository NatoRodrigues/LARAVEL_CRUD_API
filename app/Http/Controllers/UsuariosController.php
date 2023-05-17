<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::all();
        return response()->json(['data' => $usuarios], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:usuarios|max:255',
            'email' => 'required|string|unique:usuarios|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $usuario = new Usuarios();
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return response()->json(['message' => 'Usuário criado com sucesso'], 201);
    }

    public function show($id)
    {
        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        return response()->json(['data' => $usuario], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'string|unique:usuarios|max:255',
            'email' => 'string|unique:usuarios|email|max:255',
            'password' => 'string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $usuario = Usuarios::find($id);

        if (!$usuario) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $usuario->username = $request->username ?? $usuario->username;
        $usuario->email = $request->email ?? $usuario->email;
        $usuario->password = Hash::make($request->password) ?? $usuario->password;
        $usuario->save();

        return response()->json(['message' => 'Usuário atualizado com sucesso'], 200);
    }

    public function destroy($id)
    {
        Usuarios::findOrFail($id)->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso!']);
    }

}
