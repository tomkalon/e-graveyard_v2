<?php

namespace App\Core\Application\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Notification
{
    use DefaultActionTrait;

    public string $title;
    public string $type;
    public ?string $time;
    public string $content;
}
