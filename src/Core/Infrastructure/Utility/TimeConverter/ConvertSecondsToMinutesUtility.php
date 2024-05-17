<?php

namespace App\Core\Infrastructure\Utility\TimeConverter;

use App\Core\Domain\Enum\TimeUnitsEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ConvertSecondsToMinutesUtility implements TimeConverterUtilityInterface
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function convert(int $input): string
    {
        $minutes = floor($input / 60);
        return $minutes . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.minute'));
    }
}
