<?php

namespace App\Core\Infrastructure\Utility\TimeConverter;

interface TimeConverterUtilityInterface
{
    public function convert(int $input): string;
}
