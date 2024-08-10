<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Application\Service\Security;

interface LinkGeneratorServiceInterface
{
    public function generate(
        string $route,
        mixed $data,
        int $expiration,
        ?int $length = null,
        ?string $prefix = null,
        ?string $suffix = null,
    ): string;
}
