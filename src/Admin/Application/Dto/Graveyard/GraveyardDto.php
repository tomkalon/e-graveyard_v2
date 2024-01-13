<?php

namespace App\Admin\Application\Dto\Graveyard;

use App\Core\Domain\Entity\Graveyard;
use DateTimeImmutable;

class GraveyardDto
{
    public ?string $name;
    public ?string $description = null;
    public ?DateTimeImmutable $updatedAt;
    public ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $name = null,
        ?string $description = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null
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
