<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'output_id',
        'people_id',
        'description',
        'type',
        'value',
        'output_date',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function output(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Output::class);
    }

    public function people(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(People::class);
    }
}
