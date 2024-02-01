<?php

namespace App\Admin\Application\Command\Payment;

use App\Core\Application\CQRS\Command\CommandInterface;

class RemovePaymentCommand implements CommandInterface
{
    public function __construct(
        private readonly ?string $id
    )
    {
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
