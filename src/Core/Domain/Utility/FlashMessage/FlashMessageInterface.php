<?php

namespace App\Core\Domain\Utility\FlashMessage;

interface FlashMessageInterface
{
    public function add(string $name, array $data): void;
}
