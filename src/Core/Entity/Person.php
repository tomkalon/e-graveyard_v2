<?php

namespace App\Core\Entity;

use App\Core\Repository\PersonRepository;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: false)]
    private ?string $lastname = null;

}
