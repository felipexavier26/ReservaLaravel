<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservaSalaRequest;
use App\Models\ReservaSala;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ReservaSalaController extends Controller
{
    public function index()
    {
        $salas = ReservaSala::orderBy('id', 'DESC')->get();
        return response()->json([
            "status" => true,
            'salas' => $salas,
        ], 200);
    }

    public function show(ReservaSala $salas): JsonResponse
    {
        return response()->json([
            "status" => true,
            'salas' => $salas,
        ], 200);
    }

    public function store(ReservaSalaRequest $request)
    {
        DB::beginTransaction();

        try {
            $existingSala = ReservaSala::where('nome_sala', $request->nome_sala)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('dt_hr_inicio', [$request->dt_hr_inicio, $request->dt_hr_termino])
                        ->orWhereBetween('dt_hr_termino', [$request->dt_hr_inicio, $request->dt_hr_termino]);
                })
                ->first();

            if ($existingSala) {
                return response()->json([
                    "status" => false,
                    'message' => "Essa sala já está reservada para o horário informado.",
                ], 409);
            }

            $salas = ReservaSala::create([
                "nome_sala" => $request->nome_sala,
                "dt_hr_inicio" => $request->dt_hr_inicio,
                "dt_hr_termino" => $request->dt_hr_termino,
                "nome_responsavel" => $request->nome_responsavel,
                "status" => "ativas", 
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                'salas' => $salas,
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

    public function update(ReservaSalaRequest $request, $id): JsonResponse
    {

        DB::beginTransaction();

        try {
            $sala = ReservaSala::findOrFail($id);

            $existingSala = ReservaSala::where('nome_sala', $request->nome_sala)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('dt_hr_inicio', [$request->dt_hr_inicio, $request->dt_hr_termino])
                        ->orWhereBetween('dt_hr_termino', [$request->dt_hr_inicio, $request->dt_hr_termino]);
                })
                ->where('id', '!=', $sala->id)
                ->first();

            if ($existingSala) {
                return response()->json([
                    "status" => false,
                    'message' => "Essa sala já está reservada para o horário informado.",
                ], 409);
            }

            $sala->update([
                "nome_sala" => $request->nome_sala,
                "dt_hr_inicio" => $request->dt_hr_inicio,
                "dt_hr_termino" => $request->dt_hr_termino,
                "nome_responsavel" => $request->nome_responsavel,
                "status" => $request->status
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                'salas' => $sala,
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
            $sala = ReservaSala::findOrFail($id);

            $sala->delete();

            return response()->json([
                "status" => true,
                'salas' => $sala,
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
