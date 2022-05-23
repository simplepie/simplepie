<?php

$finder = (new PhpCsFixer\Finder())
    ->in('build')
    ->in('library')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;
