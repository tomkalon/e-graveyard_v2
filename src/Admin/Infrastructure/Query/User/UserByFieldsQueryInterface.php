<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Infrastructure\Query\User;

use App\Admin\Domain\View\User\UserView;
use App\Core\Application\CQRS\Query\QueryInterface;

interface UserByFieldsQueryInterface extends QueryInterface
{
    public function execute(UserView $userView): ?array;
}
