<?php

namespace App\Core\Domain\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'ROLE_ADMIN';
    case USER = 'ROLE_USER';

}
