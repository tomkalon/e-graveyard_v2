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
        private readonly TokenStorageInterface $tokenStorage,
    ) {}

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

    protected function getItemData(object $entity): string
    {
        return match (true) {
            $entity instanceof Grave => sprintf(
                '%s -> S: %d, R: %d, N: %d',
                $entity->getGraveyard()->getName(),
                $entity->getSector(),
                $entity->getRow(),
                $entity->getNumber(),
            ),
            $entity instanceof Graveyard => sprintf(
                '%s',
                $entity->getName(),
            ),
            $entity instanceof User => sprintf(
                '%s',
                $entity->getUsername(),
            ),
            $entity instanceof File => sprintf(
                '%s',
                $entity->getFilename(),
            ),
            $entity instanceof Person => sprintf(
                '%s %s',
                $entity->getFirstname(),
                $entity->getLastname(),
            ),
            $entity instanceof Payment => sprintf(
                '%d %s',
                $entity->getValue(),
                $entity->getCurrency()->value,
            ),
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
