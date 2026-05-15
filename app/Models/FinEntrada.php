<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinEntrada extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'descricao',
        'valor',
        'forma_pagamento',
        'tipo_lancamento',
        'numero_parcela',
        'data_vencimento',
        'data_pagamento',
        'status',
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
