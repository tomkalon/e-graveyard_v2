<?php

namespace App\Admin\Infrastructure\View\Payment\Grave;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Core\Infrastructure\View\ViewInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class PaymentGraveView implements ViewInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator
    ) {
    }

    /** @var $data PaymentGraveDto */
    public function getView(mixed $data, $format = null, $context = null): array
    {
        return [
            'value' => $data->getMoney(),
            'currency' => $data->currency->trans($this->translator),
            'description' => $data->description,
            'isItPaid' => $data->isItPaid(),
            'validity_time' => $data->validity_time->format('Y-m-d'),
            'grave' => $data->grave->getId()
        ];
    }
}
