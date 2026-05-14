<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fin_entrada_id',
        'fin_saida_id',
        'fin_investimento_id',
        'user_id',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function output(): BelongsTo
    {
        return $this->belongsTo(Output::class);
    }

    public function people(): BelongsTo
    {
        return $this->belongsTo(People::class);
    }
}
