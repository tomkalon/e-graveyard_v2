<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\Repository\UserRepositoryInterface;
use App\Core\Domain\Entity\User;
use Doctrine\ORM\EntityNotFoundException;
use Exception;

class GetUser implements GetUserInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    /**
     * @throws EntityNotFoundException
     */
    public function execute(string $id): User
    {
        try {
            return $this->userRepository->find($id);
        } catch (Exception $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }
}
