<?php

namespace App\Core\Infrastructure\Utility\TimeConverter;

use App\Core\Domain\Enum\TimeUnitsEnum;

interface TimeConverterUtilityInterface
{
    public function convert(int $input): string;
}
