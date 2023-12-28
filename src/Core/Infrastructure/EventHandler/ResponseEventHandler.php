<?php

namespace App\Core\Infrastructure\EventHandler;

use App\Core\Application\Utility\FlashMessage\NotificationInterface;
use App\Core\Domain\Event\ResponseListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

class ResponseEventHandler extends ResponseListener
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly NotificationInterface $flashMessage
    )
    {
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $code = $response->getStatusCode();

    }
}
