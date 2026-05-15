<?php

declare(strict_types=1);

namespace App\Http\Cadastros\Controllers;

use App\Http\Cadastros\Requests\FinReceitaRequest;
use App\Http\Controllers\Controller;
use App\Models\FinReceita;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;

class FinReceitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinReceita::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('receitas', MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinReceitaRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $records = FinReceita::create($validated);

        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('receitas', MensagensRetorno::STORE_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $records = FinReceita::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message('receitas', MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinReceitaRequest $request, FinReceita $finReceita, int $id): JsonResponse
    {
        $validated = $request->validated();
        $records = $finReceita->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message('receitas', MensagensRetorno::UPDATE_PADRAO)
                ->data($finReceita->where('id', $id)->get()->toArray())
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($finReceita->where('id', $id)->get()->toArray())
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $finReceita = FinReceita::where('id', $id)->exists();
        if ($finReceita) {
            $records = FinReceita::where('id', $id)->delete();

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
