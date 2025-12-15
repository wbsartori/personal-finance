<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum TipoInvestimento: string
{
    case APORTE = 'A';
    case RETIRADA = 'R';
    case DIVIDENDO = 'D';

    /**
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::APORTE => __('Aporte'),
            self::RETIRADA => __('Retirada'),
            self::DIVIDENDO => __('Dividendo'),
        };
    }
}
