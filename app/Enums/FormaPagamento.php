<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum FormaPagamento: string
{
    case PIX = 'PIX';
    case DEBITO = 'DEB';
    case DINHEIRO = 'DIN';
    case DEPOSITO = 'DEP';
    case BOLETO = 'BOL';
    case VALE_ALIMENTACAO = 'VAL';

    public static function toOptions(): array
    {
        return array_reduce(self::cases(), function ($status, $item) {
            $status[$item->value] = $item->toName();
            return $status;
        }, []);
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|Translator|Application|string|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::PIX => __('Pix'),
            self::DEBITO => __('Débito'),
            self::DINHEIRO => __('Dinheiro'),
            self::DEPOSITO => __('Depósito'),
            self::BOLETO => __('Boleto'),
            self::VALE_ALIMENTACAO => __('Vale Alimentação'),
        };
    }
}
