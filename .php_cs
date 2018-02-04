<?php
$header = <<<'HEADER'
This file is part of the 4devs Serialiser package.

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEADER;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'ordered_imports' => true,
        'phpdoc_order' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'array_syntax' => ['syntax' => 'short'],
        'header_comment' => [
            'header' => $header,
        ],
    ]);
