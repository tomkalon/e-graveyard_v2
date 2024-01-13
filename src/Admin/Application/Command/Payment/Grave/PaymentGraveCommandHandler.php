<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Domain\Entity\PaymentGrave;
use Doctrine\ORM\EntityManagerInterface;

class PaymentGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(PaymentGraveCommand $command)
    {
        $payment = $command->getPaymentGrave();
        $this->em->persist($payment);
    }
}
