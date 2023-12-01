<?php

namespace App\Core\Entity;

use App\Core\Repository\GraveRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
#[ORM\Entity(repositoryClass: GraveRepository::class)]
class Grave
{
    use Timestampable;

    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(nullable: false)]
    private int $sector;

    #[ORM\Column(nullable: true)]
    private ?int $row;

    #[ORM\Column(nullable: false)]
    private int $number;

    #[ORM\Column(length: 255, nullable: false)]
    private string $positionX;

    #[ORM\Column(length: 255, nullable: false)]
    private string $positionY;

    private ?File $images;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $paid = null;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
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

    public function getImages(): ?File
    {
        return $this->images;
    }

    public function setImages(?File $images): void
    {
        $this->images = $images;
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
