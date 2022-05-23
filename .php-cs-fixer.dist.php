<?php

$finder = (new PhpCsFixer\Finder())
    ->in('library')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder)
;
