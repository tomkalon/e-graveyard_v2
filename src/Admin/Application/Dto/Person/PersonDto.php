<?php

namespace App\Admin\Application\Dto\Person;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Person;

class PersonDto
{
    public ?string $firstName;
    public ?string $lastName;
    public ?\DateTimeImmutable $bornDate;
    public ?\DateTimeImmutable $deathDate;
    public ?Grave $grave;

    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?\DateTimeImmutable $bornDate = null,
        ?\DateTimeImmutable $deathDate = null,
        ?Grave $grave = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->bornDate = $bornDate;
        $this->deathDate = $deathDate;
        $this->grave = $grave;
    }

    public static function fromEntity(Person $person): self
    {
        return new self(
            $person->getFirstname(),
            $person->getLastname(),
            $person->getBornDate(),
            $person->getDeathDate(),
            $person->getGrave(),
        );
    }

    public function setGrave(?Grave $grave): void
    {
        $this->grave = $grave;
    }

}
