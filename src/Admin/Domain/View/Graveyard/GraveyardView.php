<?php

namespace App\Admin\Domain\View\Graveyard;

use App\Core\Domain\Entity\Graveyard;
use DateTimeImmutable;

class GraveyardView
{
    private ?string $name;
    private ?string $description;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
