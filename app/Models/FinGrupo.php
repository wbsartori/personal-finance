<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinGrupo extends Model
{
    use HasFactory;

    protected $table = 'fin_grupos';

    protected $fillable = ['descricao'];

    public function finSubGrupos() {
        return $this->hasMany(FinSubGrupo::class, 'fin_grupos_id');
    }
}
