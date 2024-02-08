<?php

namespace App\Admin\Infrastructure\Query\User;

use App\Core\Application\CQRS\Query\QueryInterface;
use App\Core\Domain\Entity\User;

interface GetUserInterface extends QueryInterface
{
    public function execute(
        string $id
    ): User;
}
