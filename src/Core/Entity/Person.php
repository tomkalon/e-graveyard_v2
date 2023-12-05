<?php

namespace App\Core\Entity;

use DateTimeImmutable;
use Gedmo\Timestampable\Traits\Timestampable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Person
{
    use Timestampable;

    private UuidInterface $id;
    private string $firstname;
    private string $lastname;
    private DateTimeImmutable $born_date;
    private DateTimeImmutable $death_date;
    private Grave $grave;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }


    public function getId(): UuidInterface
    {
        return $this->id;
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
