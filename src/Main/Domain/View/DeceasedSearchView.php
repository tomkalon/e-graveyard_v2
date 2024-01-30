<?php

namespace App\Main\Domain\View;

class DeceasedSearchView
{
    private ?string $firstName;
    private ?string $lastName;
    private ?int $bornYear;
    private ?int $deathYear;

    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $bornYear = null,
        ?string $deathYear = null,
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornYear = $bornYear;
        $this->deathYear = $deathYear;
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
}
