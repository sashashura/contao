<?php

declare(strict_types=1);

use Contao\EasyCodingStandard\Fixer\MultiLineLambdaFunctionArgumentsFixer;
use Contao\EasyCodingStandard\Fixer\TypeHintOrderFixer;
use Contao\EasyCodingStandard\Sniffs\UseSprintfInExceptionsSniff;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Basic\BracesFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;
use PhpCsFixer\Fixer\FunctionNotation\UseArrowFunctionsFixer;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PhpCsFixer\Fixer\ListNotation\ListSyntaxFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\IncrementStyleFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSeparationFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSummaryFixer;
use PhpCsFixer\Fixer\ReturnNotation\ReturnAssignmentFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use PhpCsFixer\Fixer\Strict\StrictComparisonFixer;
use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use SlevomatCodingStandard\Sniffs\PHP\UselessParenthesesSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\DisallowArrayTypeHintSyntaxSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use SlevomatCodingStandard\Sniffs\Whitespaces\DuplicateSpacesSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([__DIR__.'/../vendor/contao/easy-coding-standard/config/contao.php']);

    $ecsConfig->skip([
        '*/languages/*',
        '*/templates/*',
        '*/themes/*',
        BinaryOperatorSpacesFixer::class,
        DeclareStrictTypesFixer::class,
        DisallowArrayTypeHintSyntaxSniff::class,
        DuplicateSpacesSniff::class,
        IncrementStyleFixer::class,
        MethodChainingIndentationFixer::class,
        MultiLineLambdaFunctionArgumentsFixer::class,
        MultilineWhitespaceBeforeSemicolonsFixer::class,
        NoSpacesAfterFunctionNameFixer::class,
        NoSuperfluousPhpdocTagsFixer::class,
        OrderedClassElementsFixer::class,
        PhpdocOrderFixer::class,
        PhpdocScalarFixer::class,
        PhpdocSeparationFixer::class,
        PhpdocSummaryFixer::class,
        ReturnAssignmentFixer::class,
        SingleQuoteFixer::class,
        StrictComparisonFixer::class,
        StrictParamFixer::class,
        TrailingCommaInMultilineFixer::class,
        TypeHintOrderFixer::class,
        UnusedVariableSniff::class,
        UseArrowFunctionsFixer::class,
        UselessParenthesesSniff::class,
        UselessVariableSniff::class,
        UseSprintfInExceptionsSniff::class,
        VisibilityRequiredFixer::class,
        VoidReturnFixer::class,
        YodaStyleFixer::class,
    ]);

    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'long',
    ]);

    $ecsConfig->ruleWithConfiguration(BracesFixer::class, [
        'allow_single_line_closure' => true,
        'position_after_anonymous_constructs' => BracesFixer::LINE_NEXT,
        'position_after_control_structures' => BracesFixer::LINE_NEXT,
    ]);

    $ecsConfig->ruleWithConfiguration(ConcatSpaceFixer::class, [
        'spacing' => 'one',
    ]);

    $ecsConfig->ruleWithConfiguration(HeaderCommentFixer::class, [
        'header' => "This file is part of Contao.\n\n(c) Leo Feyer\n\n@license LGPL-3.0-or-later",
    ]);

    $ecsConfig->ruleWithConfiguration(ListSyntaxFixer::class, [
        'syntax' => 'long',
    ]);

    $ecsConfig->ruleWithConfiguration(NoExtraBlankLinesFixer::class, [
        'tokens' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'use',
        ],
    ]);

    $ecsConfig->parallel();
    $ecsConfig->indentation(Option::INDENTATION_TAB);
    $ecsConfig->lineEnding("\n");

    $parameters = $ecsConfig->parameters();
    $parameters->set(Option::CACHE_DIRECTORY, sys_get_temp_dir().'/ecs_legacy_cache');
};
