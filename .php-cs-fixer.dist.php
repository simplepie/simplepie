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
        '@PHP54Migration' => true,
        // TODO: Allow `const` after bump requirements to PHP >=7.1
        'visibility_required' => ['elements' => ['property', 'method', /* 'const' */]],
    ])
    ->setFinder($finder)
;
