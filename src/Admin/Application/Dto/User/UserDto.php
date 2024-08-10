<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Dto\User;

use App\Core\Domain\Entity\User;

class UserDto
{
    public ?string $email;
    public ?string $username;

    public function __construct(
        ?string $email = null,
        ?string $username = null,
    ) {
        $this->email = $email;
        $this->username = $username;
    }

    public static function fromEntity(User $user): UserDto
    {
        return new UserDto(
            $user->getEmail(),
            $user->getUsername(),
        );
    }
}
