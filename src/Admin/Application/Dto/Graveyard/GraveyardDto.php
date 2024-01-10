<?php

namespace App\Admin\Application\Dto\Graveyard;

use App\Core\Domain\Entity\Graveyard;

class GraveyardDto
{
    public ?string $name;
    public ?string $description = null;

    public function __construct(
        ?string $name = null,
        ?string $description = null
    ) {
        $this->name = $name;
        $this->description = $description;
    }

    public static function fromEntity(Graveyard $graveyard): self
    {
        return new self(
            $graveyard->getName(),
            $graveyard->getDescription()
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
}
