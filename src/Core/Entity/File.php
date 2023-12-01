<?php

namespace App\Core\Entity;

use App\Core\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class File
{
    use Timestampable;

    private UuidInterface $id;

    private string $name;

    private string $extension;

    private ?Grave $graves;
    private ?Graveyard $graveyards;

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

    public function getGraves(): ?Grave
    {
        return $this->graves;
    }

    public function setGraves(?Grave $graves): void
    {
        $this->graves = $graves;
    }
}
