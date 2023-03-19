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
        'void_return' => false,
        'phpdoc_to_param_type' => true,
        '@PHPUnit84Migration:risky' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
