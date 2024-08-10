<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Main\Domain\View\Search;

use App\Core\Domain\Entity\Grave;
use DateTime;
use DateTimeImmutable;

class DeceasedSearchView
{
    private ?string $firstName;
    private ?string $lastName;
    private ?int $bornYear;
    private ?int $deathYear;
    private ?DateTime $bornDate;
    private ?DateTime $deathDate;
    private ?bool $bornDateOnlyYear;
    private ?bool $deathDateOnlyYear;
    private ?Grave $grave;

    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $bornYear = null,
        ?string $deathYear = null,
        ?DateTime $bornDate = null,
        ?DateTime $deathDate = null,
        ?bool $bornDateOnlyYear = null,
        ?bool $deathDateOnlyYear = null,
        ?Grave $grave = null,
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornYear = $bornYear;
        $this->deathYear = $deathYear;
        $this->bornDate = $bornDate;
        $this->deathDate = $deathDate;
        $this->bornDateOnlyYear = $bornDateOnlyYear;
        $this->deathDateOnlyYear = $deathDateOnlyYear;
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

    public function getBornDate(): ?DateTime
    {
        return $this->bornDate;
    }

    public function setBornDate(?DateTime $bornDate): void
    {
        $this->bornDate = $bornDate;
    }

    public function getDeathDate(): ?DateTime
    {
        return $this->deathDate;
    }

    public function setDeathDate(?DateTime $deathDate): void
    {
        $this->deathDate = $deathDate;
    }

    public function getBornDateOnlyYear(): ?bool
    {
        return $this->bornDateOnlyYear;
    }

    public function setBornDateOnlyYear(?bool $bornDateOnlyYear): void
    {
        $this->bornDateOnlyYear = $bornDateOnlyYear;
    }

    public function getDeathDateOnlyYear(): ?bool
    {
        return $this->deathDateOnlyYear;
    }

    public function setDeathDateOnlyYear(?bool $deathDateOnlyYear): void
    {
        $this->deathDateOnlyYear = $deathDateOnlyYear;
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
