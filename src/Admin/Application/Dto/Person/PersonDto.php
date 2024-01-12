<?php

namespace App\Admin\Application\Dto\Person;

use App\Core\Domain\Entity\Person;
use DateTimeImmutable;

class PersonDto
{
    public ?string $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?DateTimeImmutable $bornDate;
    public ?DateTimeImmutable $deathDate;
    public ?string $grave;

    public function __construct(
        ?string            $id = null,
        ?string            $firstName = null,
        ?string            $lastName = null,
        ?DateTimeImmutable $bornDate = null,
        ?DateTimeImmutable $deathDate = null,
        ?string            $grave = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornDate = $bornDate;
        $this->deathDate = $deathDate;
        $this->grave = $grave;
    }

    public static function fromEntity(Person $person): self
    {
        return new self(
            $person->getId(),
            $person->getFirstname(),
            $person->getLastname(),
            $person->getBornDate(),
            $person->getDeathDate(),
            $person->getGrave()->getId(),
        );
    }

    public function setGrave(?string $grave): void
    {
        $this->grave = $grave;
    }
}
