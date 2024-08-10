<?php

namespace App\Admin\Application\Dto\Graveyard;

use App\Core\Domain\Entity\Graveyard;

class GraveyardDto
{
    public ?string $name;
    public ?string $description = null;
    public ?string $updatedAt;
    public ?string $createdAt;

    public function __construct(
        ?string $name = null,
        ?string $description = null,
        ?string $updatedAt = null,
        ?string $createdAt = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Graveyard $graveyard): self
    {
        return new self(
            $graveyard->getName(),
            $graveyard->getDescription(),
            $graveyard->getUpdatedAt(),
            $graveyard->getCreatedAt()
        );
    }
}
