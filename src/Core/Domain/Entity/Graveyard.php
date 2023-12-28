<?php

namespace App\Core\Domain\Entity;

use App\Core\Application\Trait\IdTrait;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

class Graveyard
{
    use IdTrait;

    private string $name;
    private ?string $description;
    private ?Collection $graves;
    private ?Collection $images;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->graves = new ArrayCollection();
        $this->images = new ArrayCollection();
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
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function onPrePersist(): void
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
