<?php

namespace App\Admin\Application\Command\Payment\Grave;

use App\Admin\Application\Dto\Payment\PaymentGraveDto;
use App\Core\Application\CQRS\Command\CommandInterface;

class PaymentGraveCommand implements CommandInterface
{
    public function __construct(
        private readonly PaymentGraveDto $dto,
        private readonly ?string $id = null
    )
    {
    }

    public function getDto(): PaymentGraveDto
    {
        return $this->dto;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
