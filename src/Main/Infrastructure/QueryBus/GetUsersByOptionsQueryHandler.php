<?php

namespace App\Main\Infrastructure\QueryBus;

use App\Core\CQRS\QueryBus\QueryHandlerInterface;
use App\Main\Domain\Dto\User\UserDto;
use Doctrine\ORM\EntityManagerInterface;

class GetUsersByOptionsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    )
    {
    }

    public function __invoke(GetUsersByOptionsQuery $query): UserDto
    {
        $dto = $query->getDto();
        return $dto;
    }
}
