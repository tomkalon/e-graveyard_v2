<?php

namespace App\Admin\Infrastructure\Query\Payment\Grave;

use App\Core\Application\CQRS\Query\QueryInterface;
use App\Core\Domain\Entity\PaymentGrave;

interface GetPaymentGraveInterface extends QueryInterface
{
    public function execute(
        ?string $id
    ): PaymentGrave;
}
