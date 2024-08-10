<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Trait;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

trait IdTrait
{
    private UuidInterface|string $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): string
    {
        return $this->id;
    }
}
