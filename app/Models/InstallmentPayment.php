<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'output_id',
        'original_output_id',
        'description',
        'value_of_installment',
        'payment_value',
        'payment_date',
        'installment_number',
        'payment_base_date',
        'status',
    ];
    public function output(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Output::class);
    }
}
