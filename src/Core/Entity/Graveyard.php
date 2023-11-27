<?php

namespace App\Core\Entity;

use App\Core\Repository\GraveyardRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: GraveyardRepository::class)]
class Graveyard
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(length: 1023, nullable: true)]
    private ?string $description;

    private ?File $images;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImages(): ?File
    {
        return $this->images;
    }

    public function setImages(?File $images): void
    {
        $this->images = $images;
    }
}
