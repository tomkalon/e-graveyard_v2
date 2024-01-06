<?php

namespace App\Core\Infrastructure\View;

interface ViewInterface
{
    public function getView (mixed $data, $format = null, $context = null): array;
}
