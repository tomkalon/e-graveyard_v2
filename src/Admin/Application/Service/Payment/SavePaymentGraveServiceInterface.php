<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Payment;

use App\Admin\Domain\View\Payment\PaymentGraveView;

interface SavePaymentGraveServiceInterface
{
    public function persist(PaymentGraveView $personView): void;
}
