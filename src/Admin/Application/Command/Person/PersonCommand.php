<?php

namespace App\Admin\Application\Command\Person;

use App\Admin\Application\Dto\Person\PersonDto;
use App\Core\Application\CQRS\Command\CommandInterface;

class PersonCommand implements CommandInterface
{
    public function __construct(
        private readonly PersonDto $dto,
        private readonly ?string $id = null
    )
    {
    }

    public function getDto(): PersonDto
    {
        return $this->dto;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

}
