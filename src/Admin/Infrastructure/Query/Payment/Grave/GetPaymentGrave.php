<?php

namespace App\Admin\Infrastructure\Query\Payment\Grave;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface;
use App\Core\Domain\Entity\PaymentGrave;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetPaymentGrave implements GetPaymentGraveInterface
{

    public function __construct(
        private readonly PaymentGraveRepositoryInterface $paymentGraveRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function execute(?string $id): PaymentGrave
    {
        try {
            $payment = $this->paymentGraveRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
        return $payment;
    }
}
