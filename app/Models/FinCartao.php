<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinCartao extends Model
{

    use HasFactory;

    protected $table = 'fin_cartoes';

    protected $fillable = ['descricao', 'dia_vencimento', 'bandeira', 'user_id', 'limite_uso', 'limite_real'];

    protected function limite(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: function ($value) {
                if (is_string($value)) {
                    $value = str_replace(['.', ','], ['', '.'], $value);
                }
                return (int) round(((float) $value) * 100);
            },
        );
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
