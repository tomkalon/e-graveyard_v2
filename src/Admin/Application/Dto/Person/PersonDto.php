<?php

namespace App\Admin\Application\Dto\Person;

use App\Core\Domain\Entity\Person;
use DateTimeImmutable;

class PersonDto
{
    public ?string $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $bornDate;
    public ?string $deathDate;
    public ?string $grave;

    public function __construct(
        ?string $id = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $bornDate = null,
        ?string $deathDate = null,
        ?string $grave = null
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
            $person->getBornDate()?->format('Y-m-d'),
            $person->getDeathDate()?->format('Y-m-d'),
            $person->getGrave()->getId(),
        );
    }
}
