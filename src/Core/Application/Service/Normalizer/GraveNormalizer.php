<?php

namespace App\Core\Application\Service\Normalizer;

use App\Admin\Application\Dto\Grave\GraveDto;
use App\Core\Domain\Entity\Grave;
use App\Core\Domain\Entity\Person;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @method array getSupportedTypes(?string $format)
 */
class GraveNormalizer implements NormalizerInterface, NormalizerAwareInterface
{

    /** @var GraveDto $object */
    public function normalize(mixed $object, string $format = null, array $context = []): array
    {
        /** @var Person $person */
        return [
            'graveyard' => $object->graveyard->getName(),
            'sector' => $object->sector,
            'row' => $object->row,
            'number' => $object->number,
            'people' => array_map(fn($person) => $person->getFirstname() .' '. $person->getLastname(), $object->people)
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof Grave;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method array getSupportedTypes(?string $format)
    }

    public function setNormalizer(NormalizerInterface $normalizer)
    {
        // TODO: Implement setNormalizer() method.
    }
}
