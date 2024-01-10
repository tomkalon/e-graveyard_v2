<?php

namespace App\Admin\Infrastructure\Query\Payment\Grave;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface;
use App\Core\Domain\Entity\PaymentGrave;

class GetPaymentGrave implements GetPaymentGraveInterface
{

    public function __construct(
        private readonly PaymentGraveRepositoryInterface $paymentGraveRepository
    ) {
    }

    public function execute(?string $id): PaymentGrave
    {
        return $this->paymentGraveRepository->find($id);
    }
}
