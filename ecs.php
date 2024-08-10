<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpCsFixerSets(perCS20: true, doctrineAnnotation: true)
    ->withRules([
        NoUnusedImportsFixer::class,
        ListSyntaxFixer::class,
    ])
    ->withPreparedSets(psr12: true);
