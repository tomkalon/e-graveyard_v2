<?php

namespace App\Core\Infrastructure\EventHandler\Doctrine;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\Event\Doctrine\PreUpdateListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Contracts\Translation\TranslatorInterface;

class PreUpdateEventHandler extends PreUpdateListener
{
    public function __construct()
    {
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
    }
}