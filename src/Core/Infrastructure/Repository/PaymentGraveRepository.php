<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\PaymentGrave;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentGraveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentGrave::class);
    }
}
