<?php

namespace App\Core\Entity;

use App\Core\Repository\FileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: FileRepository::class)]
class File
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $name;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $extension;

    private ?Grave $graves;

    public function __construct()
    {
        $this->id = Uuid::uuid4();

    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(?string $extension): void
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

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created', type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    private ?DateTime $updated;
}
