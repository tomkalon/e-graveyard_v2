<?php

namespace App\Core\Domain\Enum;

enum CurrencyTypeEnum: string
{
    case PLN = 'pln';
    case USD = 'usd';
    case EUR = 'eur';

    public static function toArrayValues(): array
    {
        return [
            'pln' => CurrencyTypeEnum::PLN->value,
            'usd' => CurrencyTypeEnum::USD->value,
            'eur' => CurrencyTypeEnum::EUR->value,
        ];

    }
}
