<?php

declare(strict_types=1);

$config = new PhpCsFixer\Config();
$config
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_syntax' => ['syntax' => 'short'],
        'native_function_invocation' => ['include' => ['@all'], 'scope' => 'all', 'strict' => true],
        'ordered_imports' => true,
        'declare_strict_types' => true,
        'single_import_per_statement' => false,
        'concat_space' => ['spacing' => 'one'],
        'phpdoc_align' => ['align' => 'left'],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->ignoreDotFiles(false)
            ->name(['.php-cs-fixer.dist.php'])
    )
;

return $config;
