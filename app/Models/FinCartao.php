<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinCartao extends Model
{

    use HasFactory;

    protected $table = 'fin_cartoes';

    protected $fillable = ['nome'];
}
