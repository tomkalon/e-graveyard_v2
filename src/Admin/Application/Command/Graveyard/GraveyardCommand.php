<?php

/*
 * This file has been created by Tomasz Kaliński (https://github.com/tomkalon)
 */

namespace App\Admin\Application\Command\Graveyard;

use App\Admin\Domain\View\Graveyard\GraveyardView;
use App\Core\Application\CQRS\Command\CommandInterface;

readonly class GraveyardCommand implements CommandInterface
{
    public function __construct(
        private GraveyardView $graveyard,
    ) {}

    public function getGraveyard(): GraveyardView
    {
        return $this->graveyard;
    }
}
