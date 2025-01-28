<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
        'value',
        'output_date',
        'people_id',
        'status',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function people(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(People::class);
    }

    public function installmentPayment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InstallmentPayment::class);
    }
}
