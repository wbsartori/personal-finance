<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum StatusEntrada: string
{
    case PREVISTO = 'P';
    case ATRASADO = 'A';
    case CONCLUIDO = 'C';


    /**
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::PREVISTO => __('Previsto'),
            self::ATRASADO => __('Atrasado'),
            self::CONCLUIDO => __('Concluido'),
        };
    }
}
