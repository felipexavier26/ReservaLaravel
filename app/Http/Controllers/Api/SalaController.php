<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalasRequest;
use App\Models\Sala;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::select('id', 'nome_sala')->orderBy('id', 'DESC')->get();
        return response()->json([
            "status" => true,
            'salas' => $salas,
        ], 200);
    }

    public function show(Sala $salas): JsonResponse
    {
        return response()->json([
            "status" => true,
            'salas' => $salas->only(['id', 'nome_sala']),
        ], 200);
    }

    public function store(SalasRequest $request)
    {
        DB::beginTransaction();

        try {
            $salas = Sala::create([
                "nome_sala" => $request->nome_sala,
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                'salas' => $salas->only(['id', 'nome_sala']),
                'message' => "Sala cadastrada com sucesso",
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => false,
                'message' => "Erro ao cadastrar a sala",
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function update(SalasRequest $request, $id): JsonResponse 
    {
        DB::beginTransaction();

        try {
            $sala = Sala::findOrFail($id);

            $sala->update([
                "nome_sala" => $request->nome_sala,
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                'salas' => $sala->only(['id', 'nome_sala']),
                'message' => "Sala editada com sucesso!",
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => false,
                'message' => "Erro ao editar a sala",
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $sala = Sala::findOrFail($id);

            $sala->delete();

            return response()->json([
                "status" => true,
                'salas' => $sala->only(['id', 'nome_sala']),
                'message' => "Sala apagada com sucesso!",
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                'message' => "Erro ao apagar a sala",
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
