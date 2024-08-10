<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Utility\TimeConverter;

interface TimeConverterUtilityInterface
{
    public function convert(int $input): string;
}
