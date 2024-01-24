<?php

namespace App\Core\Domain\EventListener\Exception;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
    public function onKernelException(ExceptionEvent $event)
    {
    }
}
