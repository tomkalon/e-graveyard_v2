<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum TimeUnitsEnum: string implements TranslatableInterface
{
    case MINUTE = 'minute';
    case HOUR = 'hour';
    case DAY = 'day';
    case WEEK = 'week';
    case MONTH = 'month';
    case YEAR = 'year';

    public function trans(TranslatorInterface $translator, string $locale = null): string
    {
        return match ($this) {
            self::MINUTE => $translator->trans('ui.enums.timeUnit.minute', locale: $locale),
            self::HOUR => $translator->trans('ui.enums.timeUnit.hour', locale: $locale),
            self::DAY => $translator->trans('ui.enums.timeUnit.day', locale: $locale),
            self::WEEK => $translator->trans('ui.enums.timeUnit.week', locale: $locale),
            self::MONTH => $translator->trans('ui.enums.timeUnit.month', locale: $locale),
            self::YEAR => $translator->trans('ui.enums.timeUnit.year', locale: $locale),
        };
    }
}
