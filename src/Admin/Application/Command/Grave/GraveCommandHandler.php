<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class GraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly GraveRepositoryInterface $graveRepository,
        private readonly NotificationInterface $notification,
        private readonly TranslatorInterface $translator,
    ) {
    }

    public function __invoke(GraveCommand $command)
    {
        $dto = $command->getDto();
        $id = $command->getId();

        $grave = $id ? $this->graveRepository->find($id) : new Grave();

        $grave->setGraveyard($dto->graveyard);
        $grave->setSector($dto->sector);
        $grave->setRow($dto->row);
        $grave->setNumber($dto->number);
        $grave->setPositionX($dto->positionX);
        $grave->setPositionY($dto->positionY);

        if ($id) {
            $uow = $this->em->getUnitOfWork();
            $uow->computeChangeSets();
            $changeSet = $uow->getEntityChangeSet($grave);

            if (empty($changeSet)) {
                $this->notification->addNotification('notification', new NotificationDto(
                    $this->translator->trans('notification.entity.grave', [], 'flash'),
                    NotificationTypeEnum::INFO,
                    $this->translator->trans('notification.grave.no_changes', [], 'flash')
                ));
            } else {
                $this->em->persist($grave);
            }
        } else {
            $this->em->persist($grave);
        }
    }
}
