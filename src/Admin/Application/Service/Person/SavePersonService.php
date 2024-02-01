<?php

namespace App\Admin\Application\Service\Person;

use App\Admin\Domain\View\Person\PersonView;
use App\Core\Domain\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class SavePersonService implements SavePersonServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ) {
    }

    public function persist(PersonView $personView): void
    {
        $person = new Person();
        $person->setFirstname($personView->getFirstname());
        $person->setLastname($personView->getLastname());
        $person->setBornDate($personView->getBornDate());
        $person->setDeathDate($personView->getDeathDate());
        $person->setGrave($personView->getGrave());
        $this->em->persist($person);
        $this->em->flush();
    }
}
