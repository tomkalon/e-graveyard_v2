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
        // $product = new Product();

        $grave = new Grave();
        // $manager->persist($product);

        $manager->flush();
    }
}
