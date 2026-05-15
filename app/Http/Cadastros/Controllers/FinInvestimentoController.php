<?php

declare(strict_types=1);

namespace App\Http\Cadastros\Controllers;

use App\Http\Cadastros\Requests\FinInvestimentoRequest;
use App\Http\Controllers\Controller;
use App\Models\FinInvestimento;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;

class FinInvestimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinInvestimento::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('investimentos', MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinInvestimentoRequest $request): JsonResponse
    {
        $validated = $request->validate();
        $records = FinInvestimento::create($validated);

        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('investimentos', MensagensRetorno::STORE_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $records = FinInvestimento::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('investimentos', MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinInvestimentoRequest $request, FinInvestimento $FinInvestimento, int $id): JsonResponse
    {
        $validated = $request->validate();
        $records = $FinInvestimento->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message('investimentos', MensagensRetorno::UPDATE_PADRAO)
                ->data($FinInvestimento->where('id', $id)->get()->toArray())
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($FinInvestimento->where('id', $id)->get()->toArray())
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $FinInvestimento = FinInvestimento::where('id', $id)->exists();
        if ($FinInvestimento) {
            $records = FinInvestimento::where('id', $id)->delete();

            if ($records) {
                return MensagensRetorno::make()
                    ->status(MensagensRetorno::SUCESSO)
                    ->message(MensagensRetorno::DELETE_PADRAO)
                    ->response();
            }
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->response();
    }
}
