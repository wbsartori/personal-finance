<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinReceita extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'valor', 'data_recebimento'];
}
