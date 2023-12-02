<?php

namespace App\Main\Domain\Dto\User;

class UserDto
{
    private ?string $id = null;
    private ?string $email;
    private ?string $username = null;
    /**
     * @var ?string The hashed password
     */
    private ?string $password = null;
    private ?array $roles = null;
    private ?bool $isVerified = null;

    public function __construct($email = null)
    {
        $this->email = $email;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
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
