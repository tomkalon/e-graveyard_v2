<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Application\Service\Payment\SavePaymentGraveServiceInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;

class PaymentGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly SavePaymentGraveServiceInterface $savePaymentGraveService
    ) {
    }

    public function __invoke(PaymentGraveCommand $command)
    {
        $payment = $command->getPaymentGraveView();
        $this->savePaymentGraveService->persist($payment);
    }
}
