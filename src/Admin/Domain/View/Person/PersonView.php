<?php

namespace App\Admin\Domain\View\Person;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;
use DateTimeImmutable;

class PersonView
{
    private ?string $firstname;
    private ?string $lastname;
    private DateTimeImmutable $born_date;
    private DateTimeImmutable $death_date;
    private Grave $grave;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $firstname = null,
        ?string $lastname = null,
        ?DateTimeImmutable $born_date = null,
        ?DateTimeImmutable $death_date = null,
        ?Grave $grave = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->born_date = $born_date;
        $this->death_date = $death_date;
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
            $person->getCreatedAt()
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
