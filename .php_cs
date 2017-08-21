<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('Resources')
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests');

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'array_syntax' => [
            'syntax' => 'short',
        ],
    ])
    ->setFinder($finder);
