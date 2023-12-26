<?php

namespace App\Core\Infrastructure\DataFixtures;

use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Person;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function __construct(
        private readonly Connection $connection
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $graveyard = new Graveyard();
        $graveyard->setName('Nowy Cmentarz');
        $manager->persist($graveyard);


        $query = 'SELECT * FROM grave_old';
        $statement = $this->connection->executeQuery($query);
        $results = $statement->fetchAll();

        $grave = [];
        foreach ($results as $index => $item) {
            $grave[$index] = new Grave();
            $grave[$index]->setGraveyard($graveyard);
            $grave[$index]->setSector($item['sector']);
            $grave[$index]->setRow($item['row']);
            $grave[$index]->setNumber($item['number']);
            $grave[$index]->setPositionX($item['position_x']);
            $grave[$index]->setPositionY($item['position_y']);
            $manager->persist($grave[$index]);
        }

        $manager->flush();
    }
}
