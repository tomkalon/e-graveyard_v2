<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\View\Person;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;
use DateTime;
use DateTimeImmutable;

class PersonView
{
    private ?string $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?DateTime $born_date;
    private ?DateTime $death_date;
    private ?bool $bornDateOnlyYear;
    private ?bool $deathDateOnlyYear;
    private ?int $bornYear = null;
    private ?int $deathYear = null;
    private ?Grave $grave;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $id = null,
        ?string $firstname = null,
        ?string $lastname = null,
        ?DateTime $born_date = null,
        ?DateTime $death_date = null,
        ?bool $bornDateOnlyYear = null,
        ?bool $deathDateOnlyYear = null,
        ?Grave $grave = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null,
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->born_date = $born_date;
        $this->death_date = $death_date;
        $this->bornDateOnlyYear = $bornDateOnlyYear;
        $this->deathDateOnlyYear = $deathDateOnlyYear;
        $this->grave = $grave;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Person $person): self
    {
        return new self(
            $person->getId(),
            $person->getFirstname(),
            $person->getLastname(),
            $person->getBornDate(),
            $person->getDeathDate(),
            $person->getBornDateOnlyYear(),
            $person->getDeathDateOnlyYear(),
            $person->getGrave(),
            $person->getUpdatedAt(),
            $person->getCreatedAt(),
        );
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getBornDate(): ?DateTime
    {
        return $this->born_date;
    }

    public function setBornDate(?DateTime $born_date): void
    {
        $this->born_date = $born_date;
    }

    public function getDeathDate(): ?DateTime
    {
        return $this->death_date;
    }

    public function setDeathDate(?DateTime $death_date): void
    {
        $this->death_date = $death_date;
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
