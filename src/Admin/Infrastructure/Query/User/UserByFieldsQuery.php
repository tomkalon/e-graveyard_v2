<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\Dto\User\UserDto;
use App\Admin\Infrastructure\Repository\UserRepositoryInterface;

class UserByFieldsQuery implements UserByFieldsQueryInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }
    public function execute(UserDto $dto): array
    {
        return $this->userRepository->getUsersByOptions(
            $dto->getEmail(),
            $dto->getUsername()
        );
    }
}
