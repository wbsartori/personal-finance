<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum TipoHistorico: string
{
    case ENTRADA = 'entrada';
    case SAIDA = 'saida';
    case INVESTIMENTO = 'investimento';


    /**
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::ENTRADA => __('Entradas'),
            self::SAIDA => __('Saídas'),
            self::INVESTIMENTO => __('Investimentos'),
        };
    }
}
