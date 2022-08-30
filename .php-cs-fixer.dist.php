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
        'combine_nested_dirname' => true,
    ])
    ->setFinder($finder)
;
