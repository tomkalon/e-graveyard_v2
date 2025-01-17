<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Utility\FlashMessage;

use Symfony\Component\HttpFoundation\Session\Session;

class FlashMessage implements FlashMessageInterface
{
    public function add(string $name, array $data): void
    {
        $session = new Session();
        $session->getFlashBag()->add($name, $data);
    }
}
