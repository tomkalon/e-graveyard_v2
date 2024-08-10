<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Utility\FlashMessage;

interface FlashMessageInterface
{
    public function add(string $name, array $data): void;
}
