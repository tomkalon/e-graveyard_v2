<?php

namespace App\Core\Entity;

use App\Core\Trait\IdTrait;
use App\Core\Trait\TimestampableTrait;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Grave
{
    use IdTrait;
    use TimestampableTrait;

    private int $sector;
    private ?int $row;
    private int $number;
    private string $positionX;
    private string $positionY;
    private ?Graveyard $graveyard;
    private ?Collection $people;
    private ?Collection $images;

    private ?DateTimeInterface $paid = null;

    public function __construct()
    {
        $this->people = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getSector(): int
    {
        return $this->sector;
    }

    public function setSector(int $sector): void
    {
        $this->sector = $sector;
    }

    public function getRow(): ?int
    {
        return $this->row;
    }

    public function setRow(?int $row): void
    {
        $this->row = $row;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getGraveyard(): ?Graveyard
    {
        return $this->graveyard;
    }

    public function setGraveyard(?Graveyard $graveyard): void
    {
        $this->graveyard = $graveyard;
    }

    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPeople(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people->add($person);
            $person->setGrave($this);
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
            $image->setGrave($this);
        }

        return $this;
    }

    public function getPaid(): ?DateTimeInterface
    {
        return $this->paid;
    }

    public function setPaid(?DateTimeInterface $paid): void
    {
        $this->paid = $paid;
    }

    public function getPositionX(): string
    {
        return $this->positionX;
    }

    public function setPositionX(string $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): string
    {
        return $this->positionY;
    }

    public function setPositionY(string $positionY): void
    {
        $this->positionY = $positionY;
    }
}
