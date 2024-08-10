<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Repository;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface as BasePaymentGraveRepositoryInterface;
use App\Core\Infrastructure\Repository\PaymentGraveRepository as BasePaymentGraveRepository;

class PaymentGraveRepository extends BasePaymentGraveRepository implements BasePaymentGraveRepositoryInterface {}
