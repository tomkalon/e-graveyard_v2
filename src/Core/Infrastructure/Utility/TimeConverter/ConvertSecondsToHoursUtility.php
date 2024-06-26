<?php

namespace App\Core\Infrastructure\Utility\TimeConverter;

use App\Core\Domain\Enum\TimeUnitsEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ConvertSecondsToHoursUtility implements TimeConverterUtilityInterface
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function convert(int $input): string
    {
        $hours = floor($input / 3600);
        return $hours . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.hour'));
    }
}
