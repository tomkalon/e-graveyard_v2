<?php

namespace App\Admin\UI\Api\Controller\Payment;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Admin\Infrastructure\Query\Payment\Grave\GetPaymentGraveInterface;
use App\Admin\Infrastructure\View\Payment\Grave\PaymentGraveView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentGraveController extends AbstractController
{
    public function get(
        string $id,
        GetPaymentGraveInterface $query,
        PaymentGraveView $graveView
    ): JsonResponse {
        $dto = PaymentGraveDto::fromEntity($query->execute($id));
        return new JsonResponse($graveView->getView($dto));
    }
}
