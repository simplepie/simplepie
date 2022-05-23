<?php

$finder = (new PhpCsFixer\Finder())
    ->in('build')
    ->in('demo')
    ->in('library')
    ->in('tests')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;
