<?php

namespace App\Core\Entity;

use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class File
{
    use Timestampable;

    private UuidInterface $id;
    private string $name;
    private string $extension;
    private ?bool $primary;
    private ?Grave $grave;
    private ?Graveyard $graveyard;

    public function __construct(?string $name)
    {
        $this->id = Uuid::uuid4();
        if ($name) {
            $this->name = $name;
        }
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): void
    {
        $this->extension = $extension;
    }

    public function getPrimary(): ?bool
    {
        return $this->primary;
    }

    public function setPrimary(?bool $primary): void
    {
        $this->primary = $primary;
    }

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }

    public function getGraveyard(): ?Graveyard
    {
        return $this->graveyard;
    }

    public function setGraveyard(?Graveyard $graveyard): void
    {
        $this->graveyard = $graveyard;
    }
}
