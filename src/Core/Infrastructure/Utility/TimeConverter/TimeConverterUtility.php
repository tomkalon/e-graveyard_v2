<?php

namespace App\Core\Infrastructure\Utility\TimeConverter;

use App\Core\Domain\Enum\TimeUnitsEnum;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class TimeConverterUtility implements TimeConverterUtilityInterface
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function convertSecondsToTime(int $seconds, TimeUnitsEnum $outputFormat): string
    {
        $output = null;

        switch ($outputFormat) {
            case TimeUnitsEnum::MINUTE:
                $output = $this->convertSecondsToMinutes($seconds);
                break;
            case TimeUnitsEnum::HOUR:
                $output = $this->convertSecondsToHours($seconds);
                break;
            case TimeUnitsEnum::DAY:
                $output = $this->convertSecondsToDays($seconds);
                break;
            case TimeUnitsEnum::WEEK:
                $output = $this->convertSecondsToWeeks($seconds);
                break;
            case TimeUnitsEnum::MONTH:
                $output = $this->convertSecondsToMonths($seconds);
                break;
            case TimeUnitsEnum::YEAR:
                $output = $this->convertSecondsToYears($seconds);
                break;
        }
        return $output;
    }

    private function convertSecondsToMinutes(int $seconds): string
    {
        $minutes = floor($seconds / 60);
        return $minutes . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.minute'));
    }

    private function convertSecondsToHours(int $seconds): string
    {
        $hours = floor($seconds / 3600);
        return $hours . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.hour'));
    }

    private function convertSecondsToDays(int $seconds): string
    {
        $days = floor($seconds / 86400);
        return $days . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.day'));
    }

    private function convertSecondsToWeeks(int $seconds): string
    {
        $weeks = floor($seconds / 86400);
        return $weeks . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.week'));
    }

    private function convertSecondsToMonths(int $seconds): string
    {
        $months = floor($seconds / (86400 * 30));
        return $months . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.month'));
    }

    private function convertSecondsToYears(int $seconds): string
    {
        $year = floor($seconds / (86400 * 365));
        return $year . ' ' . mb_strtolower($this->translator->trans('ui.enums.timeUnit.short.year'));
    }
}
