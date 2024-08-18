<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carregar os atendimentos junto com as relações (unidade, serviço, usuário)
        $atendimentos = Atendimento::with(['unidade', 'servico', 'usuario'])->get();

        // Transformar os dados para incluir os nomes das relações em vez dos IDs
        $atendimentos = $atendimentos->map(function ($atendimento) {
            return [
                'id' => $atendimento->id,
                'date' => $atendimento->date,
                'qtd' => $atendimento->qtd,
                'comentarios' => $atendimento->comentarios,
                'unidade' => $atendimento->unidade->name, // Nome da unidade
                'servico' => $atendimento->servico->name, // Nome do serviço
                'usuario' => $atendimento->usuario->name, // Nome do usuário
            ];
        });

        return response()->json($atendimentos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'unidade_id' => 'required|exists:unidades,id',
            'servico_id' => 'required|exists:servicos,id',
            'usuario_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'qtd' => 'required|integer',
            'comentarios' => 'nullable|string',
        ]);

        // Criação do novo atendimento
        $atendimento = Atendimento::create($validatedData);
        return response()->json($atendimento, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Carregar o atendimento específico com as relações
        $atendimento = Atendimento::with(['unidade', 'servico', 'usuario'])->findOrFail($id);

        return response()->json([
            'id' => $atendimento->id,
            'date' => $atendimento->date,
            'qtd' => $atendimento->qtd,
            'comentarios' => $atendimento->comentarios,
            'unidade' => $atendimento->unidade->name, // Nome da unidade
            'servico' => $atendimento->servico->name, // Nome do serviço
            'usuario' => $atendimento->usuario->name, // Nome do usuário
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'unidade_id' => 'required|exists:unidades,id',
            'servico_id' => 'required|exists:servicos,id',
            'usuario_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'qtd' => 'required|integer',
            'comentarios' => 'nullable|string',
        ]);

        // Atualização do atendimento
        $atendimento = Atendimento::findOrFail($id);
        $atendimento->update($validatedData);

        return response()->json($atendimento);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $atendimento = Atendimento::findOrFail($id);
        $atendimento->delete();

        return response()->json(null, 204);
    }
}
