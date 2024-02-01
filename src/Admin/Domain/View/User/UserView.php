<?php

namespace App\Admin\Domain\View\User;

use App\Core\Domain\Entity\User;

class UserView
{
    private ?string $id = null;
    private ?string $email;
    private ?string $username;
    /**
     * @var ?string The hashed password
     */
    private ?string $password = null;
    private ?string $repeatPassword = null;
    private ?array $roles = null;
    private ?bool $isVerified;

    public function __construct(
        ?string $email = null,
        ?string $username = null,
        ?bool $isVerified = null,
    ) {
        $this->email = $email;
        $this->username = $username;
        $this->isVerified = $isVerified;
    }

    public static function fromEntity(User $user): self
    {
        return new self(
            $user->getEmail(),
            $user->getUsername(),
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

    public function getRepeatPassword(): ?string
    {
        return $this->repeatPassword;
    }

    public function setRepeatPassword(?string $repeatPassword): void
    {
        $this->repeatPassword = $repeatPassword;
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
