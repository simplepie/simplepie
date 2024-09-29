<?php

$finder = (new PhpCsFixer\Finder())
    ->in('build')
    ->in('library')
    ->in('src')
    ->in('tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        'no_alias_functions' => true,
        'void_return' => false,
        '@PHPUnit84Migration:risky' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
