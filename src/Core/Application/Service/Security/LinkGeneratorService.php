<?php

namespace App\Core\Application\Service\Security;

use Exception;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class LinkGeneratorService implements LinkGeneratorServiceInterface
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly UrlGeneratorInterface $urlGenerator
    ) {
    }

    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function generate(string $route,
                             mixed $data,
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
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, false)
            ->setLength($length ?? 10);

        $generatedLink = $generator->generatePassword();

        try {
            $route = $this->urlGenerator->generate($route);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        $cacheKey = $prefix . $generatedLink . $suffix;

        $this->cache->get($cacheKey, function (ItemInterface $item) use ($data, $expiration) {
            $item->expiresAfter($expiration);
            return $data;
        });

        return $route . '/' . $cacheKey;
    }
}
