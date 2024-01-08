<?php

namespace App\Admin\Application\Command\Person;

use App\Admin\Domain\Repository\PersonRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RemovePersonCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly PersonRepositoryInterface $personRepository,
        private readonly NotificationInterface $notification,
        private readonly TranslatorInterface $translator
    ) {
    }

    public function __invoke(RemovePersonCommand $command)
    {
        $person = $this->personRepository->find($command->getId());

        if ($person) {
            $this->em->remove($person);
            $this->em->flush();
        } else {
            $this->notification->addNotification('notification', new NotificationDto(
                $this->translator->trans('notification.entity.person', [], 'flash'),
                NotificationTypeEnum::FAILED,
                $this->translator->trans('notification.person.empty', [], 'flash')
            ));
        }
    }
}
