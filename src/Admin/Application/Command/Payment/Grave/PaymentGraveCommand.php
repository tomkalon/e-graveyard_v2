<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Domain\View\Payment\PaymentGraveView;
use App\Core\Application\CQRS\Command\CommandInterface;

class PaymentGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly PaymentGraveView $paymentGraveView,
    ) {
    }

    public function getPaymentGraveView(): PaymentGraveView
    {
        return $this->paymentGraveView;
    }
}
