<?php

namespace App\Core\Domain\Entity;

use App\Core\Application\Trait\IdTrait;
use App\Core\Application\Trait\TimestampableTrait;
use DateTimeImmutable;

class Person
{
    use IdTrait;
    use TimestampableTrait;

    private string $firstname;
    private string $lastname;
    private DateTimeImmutable $born_date;
    private DateTimeImmutable $death_date;
    private Grave $grave;

    public function __construct()
    {
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

    public function getBornDate(): DateTimeImmutable
    {
        return $this->born_date;
    }

    public function setBornDate(DateTimeImmutable $born_date): void
    {
        $this->born_date = $born_date;
    }

    public function getDeathDate(): DateTimeImmutable
    {
        return $this->death_date;
    }

    public function setDeathDate(DateTimeImmutable $death_date): void
    {
        $this->death_date = $death_date;
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
