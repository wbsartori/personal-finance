<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum StatusEntrada: string
{
    case PAGAMENTO_PREVISTO = 'PP';
    case PAGAMENTO_ATRASADO = 'PA';
    case PAGAMENTO_CONCLUIDO = 'PC';


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
            self::PAGAMENTO_PREVISTO => __('Pagamento Previsto'),
            self::PAGAMENTO_ATRASADO => __('Pagamento Atrasado'),
            self::PAGAMENTO_CONCLUIDO => __('Pagamento Concluido'),
        };
    }
}
