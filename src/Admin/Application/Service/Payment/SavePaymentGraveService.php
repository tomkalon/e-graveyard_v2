<?php

namespace App\Admin\Application\Service\Payment;

use App\Admin\Domain\View\Payment\PaymentGraveView;
use App\Core\Domain\Entity\PaymentGrave;
use Doctrine\ORM\EntityManagerInterface;

class SavePaymentGraveService implements SavePaymentGraveServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    public function persist(PaymentGraveView $personView): void
    {
        $paymentGrave = new PaymentGrave();
        $paymentGrave->setValue($personView->getValue());
        $paymentGrave->setCurrency($personView->getCurrency());
        $paymentGrave->setDescription($personView->getDescription());
        $paymentGrave->setGrave($personView->getGrave());
        $paymentGrave->setValidityTime($personView->getValidityTime());
        $this->em->persist($paymentGrave);
        $this->em->flush();
    }
}
