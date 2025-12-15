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
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'cartao_credito',
        'status',
        'mes',
        'ano',
    ];
}
