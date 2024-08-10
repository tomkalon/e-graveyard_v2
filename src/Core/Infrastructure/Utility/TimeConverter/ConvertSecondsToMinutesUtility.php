<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Utility\TimeConverter;

use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ConvertSecondsToMinutesUtility implements TimeConverterUtilityInterface
{
    public function __construct(
        private TranslatorInterface $translator,
    ) {}

    public function convert(int $input): string
    {
        $minutes = floor($input / 60);
        return $minutes . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.minute'));
    }
}
