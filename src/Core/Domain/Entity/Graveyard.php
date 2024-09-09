<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Entity;

use App\Core\Domain\Trait\IdTrait;
use App\Core\Domain\Trait\LifecycleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

class Graveyard
{
    use IdTrait;
    use LifecycleTrait;

    private string $name;
    private ?string $description;
    private ?bool $isPaymentVisible;
    private ?Collection $graves;
    private ?Collection $images;

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

    public function getIsPaymentVisible(): ?bool
    {
        return $this->isPaymentVisible;
    }

    public function setIsPaymentVisible(?bool $isPaymentVisible): void
    {
        $this->isPaymentVisible = $isPaymentVisible;
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
