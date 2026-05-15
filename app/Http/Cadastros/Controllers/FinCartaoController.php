<?php

declare(strict_types=1);

namespace App\Http\Cadastros\Controllers;

use App\Http\Cadastros\Requests\FinCartaoRequest;
use App\Http\Controllers\Controller;
use App\Models\FinCartao;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;

class FinCartaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinCartao::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinCartaoRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $records = FinCartao::create($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::STORE_PADRAO)
                ->data([$records])
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($records->where('id', $request->id)->get()->toArray())
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $records = FinCartao::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinCartaoRequest $request, FinCartao $finCartao, int $id): JsonResponse
    {
        $validated = $request->validated();
        $records = $finCartao->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::UPDATE_PADRAO)
                ->data($finCartao->where('id', $id)->get()->toArray())
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($finCartao->where('id', $id)->get()->toArray())
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $finCartao = FinCartao::where('id', $id)->exists();
        if ($finCartao) {
            $records = FinCartao::where('id', $id)->delete();

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
