<?php

namespace App\Models;

use App\Enums\FormaPagamento;
use App\Enums\StatusPagamento;
use App\Enums\TipoHistorico;
use App\Enums\TipoLancamento;
use Illuminate\Database\Eloquent\Model;

class HistoricoSaida extends Model
{
    protected $fillable = [
        'user_id',
        'fin_saida_id',
        'type',
        'descricao',
        'valor',
        'forma_pagamento',
        'tipo_lancamento',
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'status',
    ];

    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento' => 'date',
        'status' => StatusPagamento::class,
        'numero_parcela' => 'integer',
        'valor' => 'decimal:2',
        'descricao' => 'string',
        'forma_pagamento' => FormaPagamento::class,
        'tipo_lancamento' => TipoLancamento::class,
        'fin_entrada_id' => 'integer',
        'user_id' => 'integer',
        'type' => TipoHistorico::class,
    ];


    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
