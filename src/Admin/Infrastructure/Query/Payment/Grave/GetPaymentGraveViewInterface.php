<?php

namespace App\Admin\Infrastructure\Query\Payment\Grave;

use App\Admin\Domain\View\Payment\PaymentGraveView;
use App\Core\Application\CQRS\Query\QueryInterface;

interface GetPaymentGraveViewInterface extends QueryInterface
{
    public function execute(
        ?string $id,
    ): ?PaymentGraveView;
}
