<?php

namespace App\Core\Entity;

use App\Core\Repository\PersonRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;
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
}
