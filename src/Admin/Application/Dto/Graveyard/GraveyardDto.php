<?php

namespace App\Admin\Application\Dto\Graveyard;

use App\Core\Domain\Entity\Graveyard;

class GraveyardDto
{
    public ?string $name;
    public ?string $description = null;


    public function __construct(
        ?int $sector = null,
        ?int $row = null,
    ) {
    }

    public static function getFromEntity(Graveyard $grave): self
    {
        return new self(
            $grave->getName(),
            $grave->getDescription(),
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
