<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\CodingStandard\Fixer\Annotation\RemovePHPStormAnnotationFixer;
use Symplify\CodingStandard\Fixer\Commenting\ParamReturnAndVarTagMalformsFixer;
use Symplify\CodingStandard\Fixer\Commenting\RemoveUselessDefaultCommentFixer;
use Symplify\CodingStandard\Fixer\Spacing\StandaloneLinePromotedPropertyFixer;
use Symplify\CodingStandard\Fixer\Strict\BlankLineAfterStrictTypesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/src/Core/Infrastructure/Migrations',
    ])
    ->withPhpCsFixerSets(
        doctrineAnnotation: true,
        perCS20: true
    )
    ->withConfiguredRule(HeaderCommentFixer::class, [
        'header' => 'This file has been created by Tomasz Kaliński (https://github.com/tomkalon)',
        'location' => 'after_open'
    ])
    ->withRules([
        NoUnusedImportsFixer::class,
        ListSyntaxFixer::class,
        StandaloneLinePromotedPropertyFixer::class,
        RemoveUselessDefaultCommentFixer::class,
        RemovePHPStormAnnotationFixer::class,
        ParamReturnAndVarTagMalformsFixer::class,
        HeaderCommentFixer::class,
        BlankLineAfterStrictTypesFixer::class,
    ])
    ->withPreparedSets(
        psr12: true
    );
