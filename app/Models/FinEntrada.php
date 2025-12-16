<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinEntrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'observacoes',
        'valor',
        'forma_pagamento',
        'tipo_lancamento',
        'tipo_investimento',
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'data_investimento',
        'cartao_credito',
        'status',
        'mes',
        'ano',
    ];
}
