<?php

namespace App\Core\Domain\Entity;

class FileGrave extends File
{
    private ?Grave $grave = null;

    public function getGrave(): ?Grave
    {
        return $this->grave;
    }

    public function setGrave(Grave $grave): void
    {
        $this->grave = $grave;
    }
}
