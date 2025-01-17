<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Core\Domain\Entity;

use App\Core\Domain\Trait\IdTrait;
use App\Core\Domain\Trait\LifecycleTrait;
use DateTime;

class Person
{
    use IdTrait;
    use LifecycleTrait;

    private string $firstname;
    private string $lastname;
    private ?DateTime $born_date;
    private ?DateTime $death_date;
    private ?bool $born_date_only_year = null;
    private ?bool $death_date_only_year = null;
    private Grave $grave;

    public function __construct(?string $id = null)
    {
        $this->setId($id);
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
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
        return $this->born_date_only_year;
    }

    public function setBornDateOnlyYear(?bool $born_date_only_year): void
    {
        $this->born_date_only_year = $born_date_only_year;
    }

    public function getDeathDateOnlyYear(): ?bool
    {
        return $this->death_date_only_year;
    }

    public function setDeathDateOnlyYear(?bool $death_date_only_year): void
    {
        $this->death_date_only_year = $death_date_only_year;
    }

    public function getGrave(): Grave
    {
        return $this->grave;
    }

    public function setGrave(Grave $grave): void
    {
        $this->grave = $grave;
    }
}
