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
        private readonly GraveRepositoryInterface $graveRepository
    )
    {
    }

    public function __invoke(PaymentGraveCommand $command)
    {
        $dto = $command->getDto();
        $grave = $this->graveRepository->find($dto->grave->id);

        $payment = new PaymentGrave();
        $payment->setGrave($grave);
        $payment->setValue($dto->value);
        $payment->setCurrency($dto->currency);
        $payment->setValidityTime($dto->validity_time);
        $payment->setDescription($dto->description);

        $this->em->persist($payment);
    }
}
