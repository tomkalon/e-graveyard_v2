<?php

namespace App\Core\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Graveyard
{
    use Timestampable;

    private UuidInterface $id;
    private string $name;
    private ?string $description;
    private ?Collection $graves;
    private ?Collection $images;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->graves = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getGraves(): ?Collection
    {
        return $this->graves;
    }

    public function addGraves(Grave $grave): self
    {
        if (!$this->graves->contains($grave)) {
            $this->graves->add($grave);
            $grave->setGraveyard($this);
        }

        return $this;
    }

    public function getImages(): ?Collection
    {
        return $this->images;
    }

    public function addImages(File $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setGraveyard($this);
        }

        return $this;
    }
}
