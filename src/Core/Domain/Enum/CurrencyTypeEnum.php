<?php

namespace App\Core\Domain\Enum;

use Symfony\Contracts\Translation\TranslatableInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

enum CurrencyTypeEnum: string implements TranslatableInterface
{
    case PLN = 'pln';
    case USD = 'usd';
    case EUR = 'eur';

    public function trans(TranslatorInterface $translator, string $locale = null): string
    {
        return match ($this) {
            self::PLN => $translator->trans('ui.enums.currencyType.pln', locale: $locale),
            self::USD => $translator->trans('ui.enums.currencyType.usd', locale: $locale),
            self::EUR => $translator->trans('ui.enums.currencyType.eur', locale: $locale),
        };
    }
}
