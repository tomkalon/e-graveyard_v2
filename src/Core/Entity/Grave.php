<?php

namespace App\Core\Entity;

use App\Core\Repository\GraveRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GraveRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Grave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?Uuid $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $row = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $paid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $positionX = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $positionY = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(?Uuid $id): void
    {
        $this->id = $id;
    }

    public function getSector(): ?int
    {
        return $this->sector;
    }

    public function setSector(?int $sector): void
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getPaid(): ?DateTimeInterface
    {
        return $this->paid;
    }

    public function setPaid(?DateTimeInterface $paid): void
    {
        $this->paid = $paid;
    }

    public function getPositionX(): ?string
    {
        return $this->positionX;
    }

    public function setPositionX(?string $positionX): void
    {
        $this->positionX = $positionX;
    }

    public function getPositionY(): ?string
    {
        return $this->positionY;
    }

    public function setPositionY(?string $positionY): void
    {
        $this->positionY = $positionY;
    }
}