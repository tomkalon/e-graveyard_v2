<?php

namespace App\Core\Entity;

use App\Core\Repository\GraveRepository;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: GraveRepository::class)]
class Grave
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'string', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(length: 255, nullable: false)]
    private ?int $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $row = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?int $number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $positionX = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $positionY = null;

    private ?File $images;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $paid = null;

    #[Gedmo\Timestampable(on: 'create')]
    #[ORM\Column(name: 'created', type: Types::DATETIME_IMMUTABLE)]
    private ?DateTimeImmutable $created;

    #[Gedmo\Timestampable(on: 'update')]
    #[ORM\Column(name: 'updated', type: Types::DATETIME_MUTABLE)]
    private ?DateTime $updated;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): ?UuidInterface
    {
        return $this->id;
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

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated;
    }
}
