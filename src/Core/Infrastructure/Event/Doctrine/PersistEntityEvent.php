<?php

namespace App\Core\Infrastructure\Event\Doctrine;

use App\Core\Application\Utility\FlashMessage\PersistEntity\PersistEntityFlashInterface;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\EventListener\Doctrine\PostPersistListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PersistEntityEvent extends PostPersistListener
{
    public function __construct(
        private readonly UrlGeneratorInterface $router,
        private readonly PersistEntityFlashInterface $flash
    ) {
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        $this->flash->handleNotification($entity);

        if ($entity instanceof Grave) {
            $url = $this->router->generate('admin_web_grave_show', ['id' => $entity->getId()]);
            $response = new RedirectResponse($url);
            $response->send();
        }
    }
}
