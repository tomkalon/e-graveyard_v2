<?php

namespace App\Core\Infrastructure\Repository;

use App\Core\Domain\Entity\PaymentGrave;
use App\Core\Domain\Repository\PaymentGraveRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PaymentGraveRepository extends ServiceEntityRepository implements PaymentGraveRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentGrave::class);
    }
}
