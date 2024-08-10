<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Infrastructure\Event;

use App\Core\Domain\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseEventHandler extends ResponseListener
{
    public function __construct(
    ) {}

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $code = $response->getStatusCode();
    }
}
