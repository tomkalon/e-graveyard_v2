<?php

namespace App\Admin\Domain\View\User;

use App\Core\Domain\Entity\User;

class UserView
{
    private ?string $id;
    private ?string $email;
    private ?string $username;
    /**
     * @var ?string The hashed password
     */
    private ?string $password;
    private ?array $roles;
    private ?bool $isVerified;

    public function __construct(
        ?string $id = null,
        ?string $email = null,
        ?string $username = null,
        ?string $password = null,
        ?array $roles = null,
        ?bool $isVerified = null,
    ) {
        $this->id = $email;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->isVerified = $isVerified;
    }

    public static function fromEntity(User $user): self
    {
        return new self(
            $user->getId(),
            $user->getEmail(),
            $user->getUsername(),
            $user->getPassword(),
            $user->getRoles(),
            $user->isVerified(),
        );
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
