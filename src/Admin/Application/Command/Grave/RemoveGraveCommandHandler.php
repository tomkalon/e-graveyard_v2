<?php

namespace App\Admin\Application\Command\Grave;

use App\Admin\Domain\Repository\GraveRepositoryInterface;
use App\Core\Application\CQRS\Command\CommandHandlerInterface;
use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Enum\NotificationTypeEnum;
use Exception;
use Symfony\Contracts\Translation\TranslatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class RemoveGraveCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(RemoveGraveCommand $command)
    {
         $this->em->remove($command->getGrave());
         $this->em->flush();
    }
}
