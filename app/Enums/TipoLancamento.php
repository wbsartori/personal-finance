<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum TipoLancamento: string
{
    case AVISTA = 'A';
    case RECORRENTE = 'R';
    case PARCELADO = 'P';

    public static function toOptions(): array
    {
        return array_reduce(self::cases(), function ($status, $item) {
            $status[$item->value] = $item->toName();
            return $status;
        }, []);
    }

    /**
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::AVISTA => __('Avista'),
            self::RECORRENTE => __('Recorrente'),
            self::PARCELADO => __('Parcelado'),
        };
    }
}
