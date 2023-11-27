<?php

namespace App\Dev\DataFixtures;

use App\Core\Entity\Grave;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $grave = new Grave();
        $grave->setSector(1);
        $grave->setNumber(1);
        $grave->setPositionX(1);
        $grave->setPositionY(1);

        $manager->persist($grave);
        $manager->flush();
    }
}
