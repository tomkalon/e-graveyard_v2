<?php

namespace App\Core\Application\Service\Security;

interface LinkGeneratorServiceInterface
{
    public function generate(
        string $route,
        int $expiration,
        ?int $length = null,
        ?string $prefix = null,
        ?string $suffix = null
    ): string;
}
