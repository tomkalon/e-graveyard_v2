<?php

namespace App\Main\Domain\Dto\User;

class UserDto
{
    private ?string $email;
    private ?string $username;
    /**
     * @var ?string The hashed password
     */
    private ?string $password;
    private ?array $roles;
    private ?bool $isVerified;

    public function __construct($email = null)
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): void
    {
        $this->roles = $roles;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(?bool $isVerified): void
    {
        $this->isVerified = $isVerified;
    }
}
