<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Service\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;
use App\Core\Domain\Entity\Graveyard;
use Doctrine\ORM\EntityManagerInterface;

readonly class SaveGraveyardService implements SaveGraveyardServiceInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function create(GraveyardView $graveyardView): void
    {
        $graveyard = new Graveyard();
        $graveyard->setName($graveyardView->getName());
        $graveyard->setDescription($graveyardView->getDescription());
        $graveyard->setIsPaymentVisible($graveyardView->getIsPaymentVisible());

        $this->em->persist($graveyard);
    }

    public function update(GraveyardView $graveyardView): void
    {
        if (!$graveyardView->getId()) {
            throw new \InvalidArgumentException('Graveyard ID is required.');
        }

        $graveyard = $this->em->getRepository(Graveyard::class)->find($graveyardView->getId());
        if (!$graveyard) {
            throw new \InvalidArgumentException('Graveyard not found.');
        }

        $graveyard->setName($graveyardView->getName());
        $graveyard->setDescription($graveyardView->getDescription());
        $graveyard->setIsPaymentVisible($graveyardView->getIsPaymentVisible());

        $this->em->persist($graveyard);
    }
}
