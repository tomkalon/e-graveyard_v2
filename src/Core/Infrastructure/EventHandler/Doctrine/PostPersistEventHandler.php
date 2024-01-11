<?php

namespace App\Core\Infrastructure\EventHandler\Doctrine;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Event\Doctrine\PostPersistListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PostPersistEventHandler extends PostPersistListener
{
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator
    )
    {
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Grave) {
            $id = $entity->getId();
            $url = $this->urlGenerator->generate('admin_web_grave_show', ['id' => $id]);

            $response = new RedirectResponse($url);
            $response->send();
        }
    }
}
