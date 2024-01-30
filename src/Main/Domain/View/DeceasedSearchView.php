<?php

namespace App\Main\Domain\View;

use App\Core\Domain\Entity\Grave;
use DateTimeImmutable;

class DeceasedSearchView
{
    private ?string $firstName;
    private ?string $lastName;
    private ?int $bornYear;
    private ?int $deathYear;
    private ?DateTimeImmutable $bornDate;
    private ?DateTimeImmutable $deathDate;
    private ?Grave $grave;

    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $bornYear = null,
        ?string $deathYear = null,
        ?DateTimeImmutable $bornDate = null,
        ?DateTimeImmutable $deathDate = null,
        ?Grave $grave = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornYear = $bornYear;
        $this->deathYear = $deathYear;
        $this->bornDate = $bornDate;
        $this->deathDate = $deathDate;
        $this->grave = $grave;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getBornYear(): ?int
    {
        return $this->bornYear;
    }

    public function setBornYear(?int $bornYear): void
    {
        $this->bornYear = $bornYear;
    }

    public function getDeathYear(): ?int
    {
        return $this->deathYear;
    }

    public function setDeathYear(?int $deathYear): void
    {
        $this->deathYear = $deathYear;
    }

    public function getBornDate(): ?DateTimeImmutable
    {
        return $this->bornDate;
    }

    public function setBornDate(?DateTimeImmutable $bornDate): void
    {
        $this->bornDate = $bornDate;
    }

    public function getDeathDate(): ?DateTimeImmutable
    {
        return $this->deathDate;
    }

    public function setDeathDate(?DateTimeImmutable $deathDate): void
    {
        $this->deathDate = $deathDate;
    }

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }

    public function getGraveyardName(): ?string
    {
        return $this->getGrave()->getGraveyard()->getName();
    }
}
