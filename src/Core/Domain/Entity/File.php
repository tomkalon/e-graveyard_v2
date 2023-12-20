<?php

namespace App\Core\Domain\Entity;

use App\Core\Application\Trait\IdTrait;
use App\Core\Application\Trait\TimestampableTrait;
use Ramsey\Uuid\Uuid;

class File
{
    use IdTrait;
    use TimestampableTrait;

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
