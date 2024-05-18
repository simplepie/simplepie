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
        // Note: phpdoc_to_param_type rule is problematic because union types aren't supported in PHP 7.2
        //'phpdoc_to_param_type' => true,
        '@PHPUnit84Migration:risky' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
