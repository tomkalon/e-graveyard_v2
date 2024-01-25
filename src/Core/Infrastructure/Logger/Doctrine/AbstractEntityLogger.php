<?php

namespace App\Core\Infrastructure\Logger\Doctrine;

use App\Core\Domain\Entity\File;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Graveyard;
use App\Core\Domain\Entity\Payment;
use App\Core\Domain\Entity\Person;
use App\Core\Domain\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

abstract class AbstractEntityLogger
{
    public function __construct(
        private readonly LoggerInterface $doctrineLifecycleLogger,
        private readonly TokenStorageInterface $tokenStorage
    ) {
    }

    public function logEvent(object $entity): void
    {
        $message = $this->createMessage($entity);
        $this->doctrineLifecycleLogger->notice($message);
    }

    protected function getEntityName(object $entity): string
    {
        return match (true) {
            $entity instanceof Grave => 'Grave',
            $entity instanceof Graveyard => 'Graveyard',
            $entity instanceof User => 'User',
            $entity instanceof File => 'File',
            $entity instanceof Person => 'Person',
            $entity instanceof Payment => 'Payment',
            default => 'UndefinedObject',
        };
    }

    protected function getLoggedUsername(): string
    {
        $token = $this->tokenStorage->getToken();
        if ($token) {
            /** @var User $user */
            $user = $token->getUser();
            return $user->getUsername();
        } else {
            return 'CommandPrompt';
        }
    }

    abstract protected function createMessage(object $entity): string;
}
