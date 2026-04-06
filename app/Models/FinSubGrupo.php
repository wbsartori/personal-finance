<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinSubGrupo extends Model
{

    protected $table = 'fin_sub_grupos';
    protected $fillable = ['descricao', 'fin_grupos_id'];

    public function finGrupo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FinGrupo::class, 'fin_grupos_id');
    }
}
