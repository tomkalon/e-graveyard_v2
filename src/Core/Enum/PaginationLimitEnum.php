<?php

namespace App\Core\Enum;

enum PaginationLimitEnum: int
{
    case LIMIT_10 = 10;
    case LIMIT_25 = 25;
    case LIMIT_50 = 50;
    case LIMIT_100 = 100;

    public static function toArray(): array
    {
        return array_column(
            [
                PaginationLimitEnum::LIMIT_10,
                PaginationLimitEnum::LIMIT_25,
                PaginationLimitEnum::LIMIT_50,
                PaginationLimitEnum::LIMIT_100,
            ],
            'value'
        );
    }
}
