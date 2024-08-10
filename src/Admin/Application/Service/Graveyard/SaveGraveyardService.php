<?php

namespace App\Admin\Application\Service\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;
use App\Core\Domain\Entity\Graveyard;
use Doctrine\ORM\EntityManagerInterface;

class SaveGraveyardService implements SaveGraveyardServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {}

    public function persist(GraveyardView $graveyardView): void
    {
        $graveyard = new Graveyard();
        $graveyard->setName($graveyardView->getName());
        $graveyard->setDescription($graveyardView->getDescription());

        $this->em->persist($graveyard);
    }
}
