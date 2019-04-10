<?php

$header = <<<'EOF'
This file is part of pmg/support

Copyright (c) PMG <https://www.pmg.com>.

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

return PhpCsFixer\Config::create()
    ->setUsingCache(false)
    ->setRiskyAllowed(true)
    ->setRules([
        'array_syntax' => ['syntax' => 'short'],
        'braces' => true,
        'blank_line_after_namespace' => true,
        'cast_spaces' => true,
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'none'],
        'elseif' => true,
        'encoding' => true,
        'function_typehint_space' => true,
        'header_comment' => [
            'header' => $header,
            'separate' => 'both',
            'location' => 'after_declare_strict',
            'commentType' => 'PHPDoc',
        ],
        'indentation_type' => true,
        'line_ending' => true,
        'lowercase_keywords' => true,
        'new_with_braces' => true,
        'no_closing_tag' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_consecutive_blank_lines' => [
            'break',
            'continue',
            'extra',
            'return',
            'use',
            'useTrait',
        ],
        'no_leading_import_slash' => true,
        'no_leading_namespace_whitespace' => true,
        'no_spaces_after_function_name' => true,
        'no_spaces_around_offset' => true,
        'no_spaces_inside_parenthesis' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
        'no_unused_imports' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'object_operator_without_whitespace' => true,
        'self_accessor' => true,
        'single_blank_line_at_eof' => true,
        'single_blank_line_before_namespace' => true,
        'single_import_per_statement' => true,
        'single_line_after_imports' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline_array' => true,
        'unary_operator_spaces' => true,
        'visibility_required' => ['property', 'method'],
        'whitespace_after_comma_in_array' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->in([
            __DIR__.'/src', 
            __DIR__.'/test',
        ]))
    ;
