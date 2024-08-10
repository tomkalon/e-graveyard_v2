<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\View\Person;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;
use DateTimeImmutable;

class PersonView
{
    private ?string $id;
    private ?string $firstname;
    private ?string $lastname;
    private ?DateTimeImmutable $born_date;
    private ?DateTimeImmutable $death_date;
    private ?bool $bornDateOnlyYear;
    private ?bool $deathDateOnlyYear;
    private ?Grave $grave;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $id = null,
        ?string $firstname = null,
        ?string $lastname = null,
        ?DateTimeImmutable $born_date = null,
        ?DateTimeImmutable $death_date = null,
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

    public function getBornDate(): ?DateTimeImmutable
    {
        return $this->born_date;
    }

    public function setBornDate(?DateTimeImmutable $born_date): void
    {
        $this->born_date = $born_date;
    }

    public function getDeathDate(): ?DateTimeImmutable
    {
        return $this->death_date;
    }

    public function setDeathDate(?DateTimeImmutable $death_date): void
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
