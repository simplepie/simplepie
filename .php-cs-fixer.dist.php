<?php

$finder = (new PhpCsFixer\Finder())
    ->in('build')
    ->in('demo')
    ->in('library')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;
