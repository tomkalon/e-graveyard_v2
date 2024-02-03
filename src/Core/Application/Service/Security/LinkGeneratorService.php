<?php

namespace App\Core\Application\Service\Security;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class LinkGeneratorService implements LinkGeneratorServiceInterface
{
    public function __construct(
        private readonly CacheInterface $cache,
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function generate(string $route,
                             int $expiration,
                             ?int $length = null,
                             ?string $prefix = null,
                             ?string $suffix = null
    ): string
    {
        $generator = new ComputerPasswordGenerator();
        $generator
            ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, false)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, false)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, false)
            ->setLength($length ?? 10);

        $generatedLink = $generator->generatePassword();

        $cacheKey = $prefix . $generatedLink . $suffix;

        $this->cache->get($cacheKey, function (ItemInterface $item) use ($route, $expiration) {
            $item->expiresAfter($expiration);
            return $route;
        });

        return $cacheKey;
    }
}
