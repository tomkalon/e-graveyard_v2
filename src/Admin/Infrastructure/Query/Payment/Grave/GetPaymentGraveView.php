<?php

namespace App\Admin\Infrastructure\Query\Payment\Grave;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface;
use App\Admin\Domain\View\Payment\PaymentGraveView;
use App\Core\Domain\Entity\PaymentGrave;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetPaymentGraveView implements GetPaymentGraveViewInterface
{

    public function __construct(
        private readonly PaymentGraveRepositoryInterface $paymentGraveRepository
    ) {
    }

    /**
     * @throws EntityNotFoundException
     * @throws Exception
     */
    public function execute(?string $id): ?PaymentGraveView
    {
        try {
            $payment = $this->paymentGraveRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }

        if ($payment) {
            return PaymentGraveView::fromEntity($payment);
        } else {
            return null;
        }
    }
}
