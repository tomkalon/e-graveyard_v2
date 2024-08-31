<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Person;

use App\Admin\Domain\View\Person\PersonView;
use App\Core\Domain\Entity\Person;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;

readonly class SavePersonService implements SavePersonServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function persist(PersonView $personView): void
    {
        $bornYear = $personView->getBornYear();
        $deathYear = $personView->getDeathYear();
        $bornDate = $personView->getBornYear() ? new DateTime("$bornYear-01-01") : $personView->getBornDate();
        $deathDate = $personView->getDeathYear() ? new DateTime("$deathYear-01-01") : $personView->getDeathDate();

        $person = new Person(Uuid::uuid4());
        $person->setFirstname($personView->getFirstname());
        $person->setLastname($personView->getLastname());
        $person->setBornDate($bornDate);
        $person->setDeathDate($deathDate);
        $person->setBornDateOnlyYear($personView->getBornDateOnlyYear());
        $person->setDeathDateOnlyYear($personView->getDeathDateOnlyYear());
        $person->setGrave($personView->getGrave());
        $this->em->persist($person);
        $this->em->flush();
    }
}
