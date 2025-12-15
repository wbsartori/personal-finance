<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinInvestimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'observacoes',
        'valor',
        'tipo',
        'data_investimento',
        'mes',
        'ano',
    ];
}
