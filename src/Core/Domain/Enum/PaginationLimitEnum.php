<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Enum;

enum PaginationLimitEnum: int
{
    case LIMIT_10 = 10;
    case LIMIT_25 = 25;
    case LIMIT_50 = 50;
    case LIMIT_100 = 100;

    public static function toArrayValues(): array
    {
        return [
            10 => self::LIMIT_10->value,
            25 => self::LIMIT_25->value,
            50 => self::LIMIT_50->value,
            100 => self::LIMIT_100->value,
        ];
    }
}
