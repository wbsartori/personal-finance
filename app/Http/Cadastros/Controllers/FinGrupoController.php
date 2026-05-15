<?php

declare(strict_types=1);

namespace App\Http\Cadastros\Controllers;

use App\Http\Cadastros\Requests\FinGrupoRequest;
use App\Http\Controllers\Controller;
use App\Models\FinGrupo;
use App\Utils\MensagensRetorno;
use Illuminate\Http\JsonResponse;

class FinGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $records = FinGrupo::all()->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::INDEX_PADRAO)
            ->data($records)
            ->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinGrupoRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $records = FinGrupo::create($validated);

        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::STORE_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $records = FinGrupo::findOrFail($id)->toArray();
        return MensagensRetorno::make()
            ->status(MensagensRetorno::SUCESSO)
            ->message(MensagensRetorno::SHOW_PADRAO)
            ->data([$records])
            ->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinGrupoRequest $request, FinGrupo $finGrupo, int $id): JsonResponse
    {
        $validated = $request->validated();
        $records = $finGrupo->where('id', $id)->update($validated);

        if ($records) {
            return MensagensRetorno::make()
                ->status(MensagensRetorno::SUCESSO)
                ->message(MensagensRetorno::UPDATE_PADRAO)
                ->data($finGrupo->where('id', $id)->get()->toArray())
                ->response();
        }
        return MensagensRetorno::make()
            ->status(MensagensRetorno::ERRO)
            ->message(MensagensRetorno::ERRO_PADRAO)
            ->data($finGrupo->where('id', $id)->get()->toArray())
            ->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $finGrupo = FinGrupo::where('id', $id)->exists();
        if ($finGrupo) {
            $records = FinGrupo::where('id', $id)->delete();

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
