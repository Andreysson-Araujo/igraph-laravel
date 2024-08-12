<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicoController extends Controller
{
    public function index()
    {   
        //Realiza a lisoagem dos servicos
        return Servico::all();
    }

    public function store(Request $request)
    {
        //realizar criação do servico
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        $existingServico = Servico::where('name', $validatedData['name'])->first();

        if($existingServico) {
            return response()->json([
                'message' => 'Servico ja existe.'
            ], Response::HTTP_FORBIDDEN);
        }

        $servico = Servico::create($validatedData);
        return response()->json($servico, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //retorna uma unidade especifica;
        return Servico::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Realizar uma atualização em um servico especifico
        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
        ]);

        $servico = Servico::findOrFail($id);
        $servico->update($validatedData);
        return response()->json($servico, 200);
    }

    public function destroy(string $id)
    {
        //Deletar um servico
        Servico::findOrFail($id)->delete();
    }
}
