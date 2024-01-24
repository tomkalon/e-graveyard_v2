<?php

namespace App\Core\Infrastructure\Event\Exception;

use App\Core\Domain\EventListener\Exception\ExceptionListener;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionEvent extends ExceptionListener
{
    public function onKernelException(\Symfony\Component\HttpKernel\Event\ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof EntityNotFoundException) {
        }
    }
}
