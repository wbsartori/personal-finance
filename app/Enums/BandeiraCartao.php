<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;

Enum BandeiraCartao: string
{
    case MASTERCARD = 'MC';
    case VISA = 'VI';


    /**
     * @return Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
     */
    public function toName(): Application|array|string|Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        return match ($this) {
            self::MASTERCARD => __('Mastercard'),
            self::VISA => __('Visa'),
        };
    }
}
