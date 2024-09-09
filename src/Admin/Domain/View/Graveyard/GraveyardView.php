<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Domain\View\Graveyard;

use App\Core\Domain\Entity\Graveyard;
use DateTimeImmutable;

class GraveyardView
{
    private ?string $id;
    private ?string $name;
    private ?string $description;
    private ?bool $isPaymentVisible = null;
    private ?array $graves;
    private ?int $peopleNumber = null;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $createdAt;

    public function __construct(
        ?string $id = null,
        ?string $name = null,
        ?string $description = null,
        ?bool $isPaymentVisible = null,
        ?array $graves = null,
        ?DateTimeImmutable $updatedAt = null,
        ?DateTimeImmutable $createdAt = null,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isPaymentVisible = $isPaymentVisible;
        $this->graves = $graves;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Graveyard $graveyard): self
    {
        return new self(
            $graveyard->getId(),
            $graveyard->getName(),
            $graveyard->getDescription(),
            $graveyard->getIsPaymentVisible(),
            $graveyard->getGraves()->toArray(),
            $graveyard->getUpdatedAt(),
            $graveyard->getCreatedAt(),
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getIsPaymentVisible(): ?bool
    {
        return $this->isPaymentVisible;
    }

    public function setIsPaymentVisible(?bool $isPaymentVisible): void
    {
        $this->isPaymentVisible = $isPaymentVisible;
    }

    public function getGraves(): ?array
    {
        return $this->graves;
    }

    public function setGraves(?array $graves): void
    {
        $this->graves = $graves;
    }

    public function getGravesNumber(): ?int
    {
        return count($this->graves);
    }

    public function getPeopleNumber(): ?int
    {
        return $this->peopleNumber;
    }

    public function setPeopleNumber(?int $peopleNumber): void
    {
        $this->peopleNumber = $peopleNumber;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
