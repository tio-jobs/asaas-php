<?php

// define which files should be analyzed
//$finder = PhpCsFixer\Finder::create()
//    ->exclude(__DIR__ . '/app/providers')
//    ->in(__DIR__ . '/app');

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src');

$config = new PhpCsFixer\Config();
return $config
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);