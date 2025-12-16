<?php

declare(strict_types=1);

namespace App\Utils;

class MensagensRetorno implements MensagensRetornoInterface
{
    public const INDEX_PADRAO  = 'Lista de registros recuperado com sucesso';
    public const STORE_PADRAO  = 'Registro criado com sucesso';
    public const SHOW_PADRAO   = 'Registro encontrado com sucesso';
    public const UPDATE_PADRAO = 'Registro atualizado com sucesso';
    public const DELETE_PADRAO = 'Registro excluído com sucesso';
    public const ERRO_PADRAO = 'Ocorreu um erro ao tentar executar esta operação';
    public const CUSTOMIZADA = '%s';
    public const SUCESSO = 'sucesso';
    public const ERRO = 'erro';
    public const AVISO = 'aviso';

    private string $status = 'success';
    private string $message = '';
    private array $data = [];

    public static function make(): MensagensRetornoInterface
    {
        return new self();
    }

    public function status(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function message(string $title, string $entity = null): self
    {
        $message = $title;
        if($entity) {
            $message = str_replace('%s', $title, $entity);
        }
        $this->message = $message;
        return $this;
    }

    public function data(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function response(int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => $this->status,
            'message' => $this->message,
            'data'    => $this->data,
        ], $statusCode);
    }
}
