<?php

$finder = (new PhpCsFixer\Finder())
    ->in('build')
    ->in('demo')
    ->in('library')
    ->in('src')
    ->in('tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        'declare_strict_types' => false,
        'void_return' => false,
        '@PHPUnit84Migration:risky' => true,
    ])
    ->setFinder($finder)
;
