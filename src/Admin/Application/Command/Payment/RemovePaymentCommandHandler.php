<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Payment;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class RemovePaymentCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly PaymentGraveRepositoryInterface $paymentGraveRepository,
        private readonly EntityManagerInterface $em,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function __invoke(RemovePaymentCommand $command)
    {
        try {
            $payment = $this->paymentGraveRepository->find($command->getId());
            if ($payment) {
                $this->em->remove($payment);
                $this->em->flush();
            } else {
                throw new EntityNotFoundException();
            }
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
