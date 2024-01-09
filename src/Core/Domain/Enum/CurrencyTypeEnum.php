<?php

namespace App\Core\Domain\Enum;

enum CurrencyTypeEnum: string
{
    case PLN = 'pln';
    case USD = 'usd';
    case EUR = 'eur';
}
