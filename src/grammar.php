<?php

use \DataTypes\Parser\Ast;

return [
    'initial' => 'Document',
    'tokens' => [
        'default' => [
            'T_HEREDOC' => '<<<\\h*(\\w+)[\\s\\S]*?\\n\\h*\\g{-1}',
            'T_NOWDOC' => '<<<\\h*\\\'(\\w+)\\\'[\\s\\S]*?\\n\\h*\\g{-1}',
            'T_INTERPOLATE_STRING' => '"([^"\\\\]*(?:\\\\.[^"\\\\]*)*)"',
            'T_STRING' => '\\\'([^\\\'\\\\]*(?:\\\\.[^\\\'\\\\]*)*)\\\'',
            'T_HEX_NUMBER' => '0x[0-9a-fA-F]+(?:[eE][\\+\\-]?[0-9]+)?',
            'T_OCT_NUMBER' => '0[0-9]+(?:[eE][\\+\\-]?[0-9]+)?',
            'T_FLOAT_NUMBER' => '([0-9]*\\.[0-9]+|[0-9]+\\.[0-9]*)(?:[eE][\\+\\-]?[0-9]+)?',
            'T_INT_NUMBER' => '(?:0|[1-9][0-9]*)(?:[eE][\\+\\-]?[0-9]+)?',
            'T_NS' => '\\\\',
            'T_SEMICOLON' => ';',
            'T_DOUBLE_COLON' => '::',
            'T_COLON' => ':',
            'T_COMMA' => ',',
            'T_QUESTION_MARK' => '\\?',
            'T_AND' => '&',
            'T_OR' => '\\|',
            'T_ASSIGN' => '=',
            'T_ANGLE_LEFT' => '<',
            'T_ANGLE_RIGHT' => '>',
            'T_PARENTHESIS_OPEN' => '\\(',
            'T_PARENTHESIS_CLOSE' => '\\)',
            'T_BRACKET_OPEN' => '\\[',
            'T_BRACKET_CLOSE' => '\\]',
            'T_BRACE_OPEN' => '{',
            'T_BRACE_CLOSE' => '}',
            'T_VARIABLE' => '\\$[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*',
            'T_TYPE' => '\\btype\\b',
            'T_FUNCTION' => '\\bfunction\\b',
            'T_INTERFACE' => '\\binterface\\b',
            'T_CLASS' => '\\bclass\\b',
            'T_TRAIT' => '\\btrait\\b',
            'T_PUBLIC' => '\\bpublic\\b',
            'T_PROTECTED' => '\\bprotected\\b',
            'T_PRIVATE' => '\\bprivate\\b',
            'T_INTERNAL' => '\\binternal\\b',
            'T_VIRTUAL' => '\\bvirtual\\b',
            'T_STATIC' => '\\bstatic\\b',
            'T_OUT' => '\\bout\\b',
            'T_IN' => '\\bin\\b',
            'T_NAME' => '[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff\\-]*',
            'T_COMMENT' => '(//|#)[^\\n]*\\n',
            'T_DOC_COMMENT' => '/\\*.*?\\*/',
            'T_WHITESPACE' => '(\\xfe\\xff|\\x20|\\x09|\\x0a|\\x0d)+',
        ],
    ],
    'skip' => [
        'T_COMMENT',
        'T_DOC_COMMENT',
        'T_WHITESPACE',
    ],
    'transitions' => [
        
    ],
    'grammar' => [
        0 => new \Phplrt\Grammar\Lexeme('T_TYPE', true),
        'ClassLikeStatement' => new \Phplrt\Grammar\Alternation([65, 66, 67]),
        'FunctionStatement' => new \Phplrt\Grammar\Concatenation([100, 88]),
        'MethodStatement' => new \Phplrt\Grammar\Concatenation([87, 88]),
        'Type' => new \Phplrt\Grammar\Concatenation([43]),
        'TypeStatement' => new \Phplrt\Grammar\Concatenation([118, 119, 43, 120]),
        1 => new \Phplrt\Grammar\Lexeme('T_FUNCTION', true),
        2 => new \Phplrt\Grammar\Lexeme('T_INTERFACE', true),
        3 => new \Phplrt\Grammar\Lexeme('T_CLASS', true),
        4 => new \Phplrt\Grammar\Lexeme('T_TRAIT', true),
        5 => new \Phplrt\Grammar\Lexeme('T_OUT', true),
        6 => new \Phplrt\Grammar\Lexeme('T_IN', true),
        7 => new \Phplrt\Grammar\Lexeme('T_PUBLIC', true),
        8 => new \Phplrt\Grammar\Lexeme('T_PROTECTED', true),
        9 => new \Phplrt\Grammar\Lexeme('T_PRIVATE', true),
        10 => new \Phplrt\Grammar\Lexeme('T_STATIC', true),
        11 => new \Phplrt\Grammar\Lexeme('T_INTERNAL', true),
        12 => new \Phplrt\Grammar\Lexeme('T_VIRTUAL', true),
        13 => new \Phplrt\Grammar\Alternation([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
        14 => new \Phplrt\Grammar\Alternation([13, 18]),
        15 => new \Phplrt\Grammar\Optional(29),
        16 => new \Phplrt\Grammar\Concatenation([14, 15]),
        17 => new \Phplrt\Grammar\Lexeme('T_VARIABLE', true),
        18 => new \Phplrt\Grammar\Lexeme('T_NAME', true),
        19 => new \Phplrt\Grammar\Concatenation([24, 14, 25]),
        20 => new \Phplrt\Grammar\Concatenation([14, 28]),
        21 => new \Phplrt\Grammar\Alternation([19, 20]),
        22 => new \Phplrt\Grammar\Lexeme('T_NS', false),
        23 => new \Phplrt\Grammar\Concatenation([22, 14]),
        24 => new \Phplrt\Grammar\Lexeme('T_NS', false),
        25 => new \Phplrt\Grammar\Repetition(23, 0, INF),
        26 => new \Phplrt\Grammar\Lexeme('T_NS', false),
        27 => new \Phplrt\Grammar\Concatenation([26, 14]),
        28 => new \Phplrt\Grammar\Repetition(27, 0, INF),
        29 => new \Phplrt\Grammar\Concatenation([33, 30, 34, 35]),
        30 => new \Phplrt\Grammar\Concatenation([36, 14, 39]),
        31 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        32 => new \Phplrt\Grammar\Concatenation([31, 30]),
        33 => new \Phplrt\Grammar\Lexeme('T_ANGLE_LEFT', false),
        34 => new \Phplrt\Grammar\Repetition(32, 0, INF),
        35 => new \Phplrt\Grammar\Lexeme('T_ANGLE_RIGHT', false),
        36 => new \Phplrt\Grammar\Optional(40),
        37 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        38 => new \Phplrt\Grammar\Concatenation([37, 'Type']),
        39 => new \Phplrt\Grammar\Optional(38),
        40 => new \Phplrt\Grammar\Alternation([41, 42]),
        41 => new \Phplrt\Grammar\Lexeme('T_IN', true),
        42 => new \Phplrt\Grammar\Lexeme('T_OUT', true),
        43 => new \Phplrt\Grammar\Concatenation([44]),
        44 => new \Phplrt\Grammar\Concatenation([45, 48]),
        45 => new \Phplrt\Grammar\Concatenation([49, 52]),
        46 => new \Phplrt\Grammar\Lexeme('T_AND', false),
        47 => new \Phplrt\Grammar\Concatenation([46, 44]),
        48 => new \Phplrt\Grammar\Optional(47),
        49 => new \Phplrt\Grammar\Alternation([55, 56]),
        50 => new \Phplrt\Grammar\Lexeme('T_OR', false),
        51 => new \Phplrt\Grammar\Concatenation([50, 45]),
        52 => new \Phplrt\Grammar\Optional(51),
        53 => new \Phplrt\Grammar\Lexeme('T_PARENTHESIS_OPEN', false),
        54 => new \Phplrt\Grammar\Lexeme('T_PARENTHESIS_CLOSE', false),
        55 => new \Phplrt\Grammar\Concatenation([53, 'Type', 54]),
        56 => new \Phplrt\Grammar\Concatenation([21, 58]),
        57 => new \Phplrt\Grammar\Concatenation([62, 59, 63, 64]),
        58 => new \Phplrt\Grammar\Optional(57),
        59 => new \Phplrt\Grammar\Concatenation([43]),
        60 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        61 => new \Phplrt\Grammar\Concatenation([60, 59]),
        62 => new \Phplrt\Grammar\Lexeme('T_ANGLE_LEFT', false),
        63 => new \Phplrt\Grammar\Repetition(61, 0, INF),
        64 => new \Phplrt\Grammar\Lexeme('T_ANGLE_RIGHT', false),
        65 => new \Phplrt\Grammar\Concatenation([71, 16, 68, 72]),
        66 => new \Phplrt\Grammar\Concatenation([74, 16, 68, 75]),
        67 => new \Phplrt\Grammar\Concatenation([77, 16, 78]),
        68 => new \Phplrt\Grammar\Optional(79),
        69 => new \Phplrt\Grammar\Concatenation([84, 85, 86]),
        70 => new \Phplrt\Grammar\Lexeme('T_SEMICOLON', false),
        71 => new \Phplrt\Grammar\Lexeme('T_CLASS', false),
        72 => new \Phplrt\Grammar\Alternation([69, 70]),
        73 => new \Phplrt\Grammar\Lexeme('T_SEMICOLON', false),
        74 => new \Phplrt\Grammar\Lexeme('T_INTERFACE', false),
        75 => new \Phplrt\Grammar\Alternation([69, 73]),
        76 => new \Phplrt\Grammar\Lexeme('T_SEMICOLON', false),
        77 => new \Phplrt\Grammar\Lexeme('T_TRAIT', false),
        78 => new \Phplrt\Grammar\Alternation([69, 76]),
        79 => new \Phplrt\Grammar\Concatenation([82, 56, 83]),
        80 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        81 => new \Phplrt\Grammar\Concatenation([80, 56]),
        82 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        83 => new \Phplrt\Grammar\Repetition(81, 0, INF),
        84 => new \Phplrt\Grammar\Lexeme('T_BRACE_OPEN', false),
        85 => new \Phplrt\Grammar\Repetition('MethodStatement', 0, INF),
        86 => new \Phplrt\Grammar\Lexeme('T_BRACE_CLOSE', false),
        87 => new \Phplrt\Grammar\Repetition(91, 0, INF),
        88 => new \Phplrt\Grammar\Concatenation([107, 16, 108, 105, 109, 106, 110]),
        89 => new \Phplrt\Grammar\Alternation([95, 96, 97, 98, 99]),
        90 => new \Phplrt\Grammar\Concatenation([93, 94]),
        91 => new \Phplrt\Grammar\Alternation([89, 90]),
        92 => new \Phplrt\Grammar\Lexeme('T_QUESTION_MARK', true),
        93 => new \Phplrt\Grammar\Lexeme('T_STATIC', true),
        94 => new \Phplrt\Grammar\Optional(92),
        95 => new \Phplrt\Grammar\Lexeme('T_PUBLIC', true),
        96 => new \Phplrt\Grammar\Lexeme('T_PROTECTED', true),
        97 => new \Phplrt\Grammar\Lexeme('T_PRIVATE', true),
        98 => new \Phplrt\Grammar\Lexeme('T_VIRTUAL', true),
        99 => new \Phplrt\Grammar\Lexeme('T_INTERNAL', true),
        100 => new \Phplrt\Grammar\Optional(101),
        101 => new \Phplrt\Grammar\Alternation([102, 103]),
        102 => new \Phplrt\Grammar\Lexeme('T_INTERNAL', true),
        103 => new \Phplrt\Grammar\Lexeme('T_VIRTUAL', true),
        104 => new \Phplrt\Grammar\Lexeme('T_FUNCTION', false),
        105 => new \Phplrt\Grammar\Optional(112),
        106 => new \Phplrt\Grammar\Concatenation([111, 'Type']),
        107 => new \Phplrt\Grammar\Optional(104),
        108 => new \Phplrt\Grammar\Lexeme('T_PARENTHESIS_OPEN', false),
        109 => new \Phplrt\Grammar\Lexeme('T_PARENTHESIS_CLOSE', false),
        110 => new \Phplrt\Grammar\Lexeme('T_SEMICOLON', false),
        111 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        112 => new \Phplrt\Grammar\Concatenation([113, 116]),
        113 => new \Phplrt\Grammar\Concatenation([17, 117, 'Type']),
        114 => new \Phplrt\Grammar\Lexeme('T_COMMA', false),
        115 => new \Phplrt\Grammar\Concatenation([114, 113]),
        116 => new \Phplrt\Grammar\Repetition(115, 0, INF),
        117 => new \Phplrt\Grammar\Lexeme('T_COLON', false),
        119 => new \Phplrt\Grammar\Lexeme('T_ASSIGN', false),
        120 => new \Phplrt\Grammar\Lexeme('T_SEMICOLON', false),
        121 => new \Phplrt\Grammar\Lexeme('T_TYPE', false),
        118 => new \Phplrt\Grammar\Concatenation([121, 14, 15]),
        'Document' => new \Phplrt\Grammar\Repetition('Definition', 0, INF),
        'Definition' => new \Phplrt\Grammar\Alternation(['ClassLikeStatement', 'FunctionStatement', 'TypeStatement'])
    ],
    'reducers' => [
        17 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Identifier(substr($children->getValue(), 1));
        },
        14 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Identifier($children->getValue());
        },
        19 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Name($children, true);
        },
        20 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Name($children, false);
        },
        15 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new \ArrayObject($children ?? []);
        },
        30 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Stmt\GenericParameter(
            $children[1],
            $children[0],
            $children[2] ?? null
        );
        },
        36 => function (\Phplrt\Parser\Context $ctx, $children) {
            return is_int($children) ? $children : Ast\Stmt\GenericParameter::VARIANCE_ANY;
        },
        40 => function (\Phplrt\Parser\Context $ctx, $children) {
            if ($children->getName() === 'T_IN') {
            return Ast\Stmt\GenericParameter::VARIANCE_IN;
        }
    
        return Ast\Stmt\GenericParameter::VARIANCE_OUT;
        },
        44 => function (\Phplrt\Parser\Context $ctx, $children) {
            if (\count($children) === 2) {
            return new Ast\Expr\AndExpression($children[0], $children[1]);
        }
    
        return $children;
        },
        45 => function (\Phplrt\Parser\Context $ctx, $children) {
            if (\count($children) === 2) {
            return new Ast\Expr\OrExpression($children[0], $children[1]);
        }
    
        return $children;
        },
        56 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Expr\TypeArgument(
            \array_shift($children),
            $children
        );
        },
        'ClassLikeStatement' => function (\Phplrt\Parser\Context $ctx, $children) {
            $class = array_shift($children);
    
        $result = new $class(
            array_shift($children),
            array_shift($children),
            array_shift($children)
        );
    
        if (isset($children[0])) {
            foreach ($children[0] as $member) {
                if ($member instanceof Ast\Stmt\MethodStatement) {
                    $result->methods[] = $member;
                    continue;
                }
    
                if ($member instanceof Ast\Stmt\PropertyStatement) {
                    $result->properties[] = $member;
                    continue;
                }
            }
        }
    
        return $result;
        },
        65 => function (\Phplrt\Parser\Context $ctx, $children) {
            return [Ast\Stmt\ClassStatement::class, ...$children];
        },
        66 => function (\Phplrt\Parser\Context $ctx, $children) {
            return [Ast\Stmt\InterfaceStatement::class, ...$children];
        },
        67 => function (\Phplrt\Parser\Context $ctx, $children) {
            return [Ast\Stmt\TraitStatement::class, ...$children];
        },
        68 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new ArrayObject($children ?? []);
        },
        69 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new ArrayObject($children);
        },
        'MethodStatement' => function (\Phplrt\Parser\Context $ctx, $children) {
            $modifiers = 0;
    
        while(count($children) > 1) {
            $modifiers |= array_shift($children);
        }
    
        return new Ast\Stmt\MethodStatement(end($children), $modifiers);
        },
        87 => function (\Phplrt\Parser\Context $ctx, $children) {
            return array_reduce($children, fn($carry, $i) => $carry |= $i, 0);
        },
        90 => function (\Phplrt\Parser\Context $ctx, $children) {
            return count($children) === 1
            ? Ast\Stmt\MethodStatement::IS_STATIC
            : Ast\Stmt\MethodStatement::IS_OPT_STATIC;
        },
        89 => function (\Phplrt\Parser\Context $ctx, $children) {
            switch($children->getName()) {
            case 'T_PRIVATE':
                return Ast\Stmt\MethodStatement::IS_PRIVATE;
    
            case 'T_PROTECTED':
                return Ast\Stmt\MethodStatement::IS_PROTECTED;
    
            case 'T_VIRTUAL':
                return Ast\Stmt\MethodStatement::IS_VIRTUAL;
    
            case 'T_INTERNAL':
                return Ast\Stmt\MethodStatement::IS_INTERNAL;
    
            default:
                return Ast\Stmt\MethodStatement::IS_PUBLIC;
        }
        },
        'FunctionStatement' => function (\Phplrt\Parser\Context $ctx, $children) {
            $modifier = array_shift($children);
    
        $result = array_shift($children);
        $result->modifier = $modifier;
    
        return $result;
        },
        100 => function (\Phplrt\Parser\Context $ctx, $children) {
            if ($children === []) {
            return 0;
        }
    
        switch ($children->getName()) {
            case 'T_INTERNAL':
                return Ast\Stmt\FunctionStatement::IS_INTERNAL;
    
            case 'IS_VIRTUAL':
                return Ast\Stmt\FunctionStatement::IS_VIRTUAL;
    
            default:
                return 0;
        }
        },
        88 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Stmt\FunctionStatement(
            array_shift($children),
            array_pop($children),
            $children[0],
            $children[1]
        );
        },
        106 => function (\Phplrt\Parser\Context $ctx, $children) {
            return reset($children);
        },
        105 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new \ArrayObject($children ?? []);
        },
        113 => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Stmt\FunctionParameter(...$children);
        },
        'TypeStatement' => function (\Phplrt\Parser\Context $ctx, $children) {
            return new Ast\Stmt\TypeStatement(
            $children[0],
            $children[1],
            $children[2]
        );
        }
    ]
];