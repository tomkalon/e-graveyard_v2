<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Domain\Repository\PaymentGraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RemovePaymentCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly PaymentGraveRepositoryInterface $paymentGraveRepository,
        private readonly EntityManagerInterface $em,
        private readonly NotificationInterface $notification,
        private readonly TranslatorInterface $translator
    )
    {
    }

    public function __invoke(RemovePaymentCommand $command)
    {
        $payment = $this->paymentGraveRepository->find($command->getId());

        if ($payment) {
            $this->em->remove($payment);
            $this->em->flush();
        } else {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.entity.paymentGrave', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.paymentGrave.empty', [], 'flash')
            ));
        }
    }
}