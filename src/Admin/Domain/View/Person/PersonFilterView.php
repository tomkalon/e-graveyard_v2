<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\View\Person;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;
use DateTime;
use DateTimeImmutable;

class PersonFilterView
{
    private ?string $firstname;
    private ?string $lastname;
    private ?int $bornYear;
    private ?int $deathYear;
    private ?Grave $grave;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $firstname = null,
        ?string $lastname = null,
        ?int $bornYear = null,
        ?int $deathYear = null,
        ?Grave $grave = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null,
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bornYear = $bornYear;
        $this->deathYear = $deathYear;
        $this->grave = $grave;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Person $person): self
    {
        return new self(
            $person->getFirstname(),
            $person->getLastname(),
            $person->getBornDate(),
            $person->getDeathDate(),
            $person->getGrave(),
            $person->getUpdatedAt(),
            $person->getCreatedAt(),
        );
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getDeathYear(): ?int
    {
        return $this->deathYear;
    }

    public function setDeathYear(?int $deathYear): void
    {
        $this->deathYear = $deathYear;
    }

    public function getBornYear(): ?int
    {
        return $this->bornYear;
    }

    public function setBornYear(?int $bornYear): void
    {
        $this->bornYear = $bornYear;
    }

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
