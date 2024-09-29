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

    public function __construct(
        ?string $firstname = null,
        ?string $lastname = null,
        ?int $bornYear = null,
        ?int $deathYear = null,
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bornYear = $bornYear;
        $this->deathYear = $deathYear;
    }

    public static function fromEntity(Person $person): self
    {
        return new self(
            $person->getFirstname(),
            $person->getLastname(),
            $person->getBornDate(),
            $person->getDeathDate(),
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
}
