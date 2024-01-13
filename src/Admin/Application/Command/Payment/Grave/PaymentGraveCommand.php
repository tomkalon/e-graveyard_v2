<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Core\Application\CQRS\Command\CommandInterface;
use App\Core\Domain\Entity\PaymentGrave;

class PaymentGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly PaymentGrave $paymentGrave,
    ) {
    }

    public function getPaymentGrave(): PaymentGrave
    {
        return $this->paymentGrave;
    }
}
