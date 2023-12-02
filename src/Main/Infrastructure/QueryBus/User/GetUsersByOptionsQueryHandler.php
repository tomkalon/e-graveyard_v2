<?php

namespace App\Main\Infrastructure\QueryBus\User;

use App\Core\CQRS\QueryBus\QueryHandlerInterface;
use App\Main\Domain\Repository\UserRepositoryInterface;

class GetUsersByOptionsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function __invoke(GetUsersByOptionsQuery $query): ?array
    {
        $dto = $query->getDto();
        return $this->userRepository->getUsersByOptions($dto);
    }
}
