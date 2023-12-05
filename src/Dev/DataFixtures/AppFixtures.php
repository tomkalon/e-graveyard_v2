<?php

namespace App\Dev\DataFixtures;

use App\Core\Entity\Grave;
use App\Core\Entity\Graveyard;
use App\Core\Entity\Person;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $graveyard = new Graveyard();
        $graveyard->setName('Stary Cmentarz');
        $manager->persist($graveyard);

        $person = new Person();
        $person->setFirstname('Jan');
        $person->setLastname('Kowalski');
        $person->setLastname('Kowalski');
        $person->setBornDate(new DateTimeImmutable('1950-01-1'));
        $person->setDeathDate(new DateTimeImmutable('1990-01-1'));
        $manager->persist($person);

        $grave = new Grave();
        $grave->setSector(1);
        $grave->setNumber(1);
        $grave->setPositionX(1);
        $grave->setPositionY(1);
        $grave->addPeople($person);
        $grave->setGraveyard($graveyard);
        $manager->persist($grave);

        $manager->flush();
    }
}
