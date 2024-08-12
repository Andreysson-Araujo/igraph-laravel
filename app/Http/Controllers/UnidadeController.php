<?php

namespace App\Http\Controllers;

use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnidadeController extends Controller
{
    public function index()
    {
        /*Lista as unidades recuperando os registro da tabela*/
        return Unidade::all();
    }

    public function store(Request $request)
    {
        //Criando novo registro na tabela de 'UNIDADES'
        $validatedData= $request->validate([
            'name'=> 'required|string|max:255',
            'inaugural_date' => 'required|date'
        ]);


        $existingUnidade = Unidade::where('name', $validatedData['name'])->first();

        if($existingUnidade) {
            //Retorna um 403

            return response()->json([
                'message' => 'Unidade ja existe.'
            ], Response::HTTP_FORBIDDEN);
        }
        
        $unidade = Unidade::create($validatedData);
        return response()->json($unidade, 201);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //retorna uma unidade especifica;
        return Unidade::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Realizar uma atualização em uma unidade especifica 
        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
            'inaugural_date'=>'required|date'
        ]);
        
        $unidade = Unidade::findOrFail($id);
        $unidade->update($validatedData);
        return response()->json($unidade, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //deletar uma unidade
        Unidade::findOrFail($id)-> delete();

        
    }
}
