<?php

namespace App\Core\Infrastructure\Service\ApiView;

interface ViewInterface
{
    public function getView (mixed $data, $format = null, $context = null): array;
}
