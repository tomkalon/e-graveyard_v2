<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\DTO\FlashMessage\NotificationDto;
use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Entity\User;
use App\Core\Domain\Enum\NotificationTypeEnum;
use App\Core\Domain\EventListener\Doctrine\PostPersistListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateEntityEvent extends PostPersistListener
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage,
        private readonly UrlGeneratorInterface $urlGenerator
    )
    {
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        $title = match (true) {
            $entity instanceof Grave => $this->translator->trans('notification.entity.grave', [], 'flash'),
            $entity instanceof Graveyard => $this->translator->trans('notification.entity.graveyard', [], 'flash'),
            $entity instanceof User => $this->translator->trans('notification.entity.user', [], 'flash'),
            $entity instanceof File => $this->translator->trans('notification.entity.file', [], 'flash'),
            $entity instanceof Person => $this->translator->trans('notification.entity.person', [], 'flash'),
            $entity instanceof PaymentGrave => $this->translator->trans('notification.entity.paymentGrave', [], 'flash'),
            default => $this->translator->trans('notification.lifecycle.create.title', [], 'flash'),
        };

        $content = match (true) {
            $entity instanceof Person => $this->translator->trans('notification.lifecycle.create.person.content', [], 'flash'),
            $entity instanceof PaymentGrave => $this->translator->trans('notification.lifecycle.create.paymentGrave.content', [], 'flash'),
            default => $this->translator->trans('notification.lifecycle.create.content', [], 'flash')
        };

        $this->flashMessage->addNotification('notification', new NotificationDto(
            $title,
            NotificationTypeEnum::SUCCESS,
            $content
        ));

        if ($entity instanceof Grave) {
            $id = $entity->getId();
            $url = $this->urlGenerator->generate('admin_web_grave_show', ['id' => $id]);
        }
    }
}
