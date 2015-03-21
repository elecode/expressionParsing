<?php

namespace Elecode\ExpressionParsing\Expression;

use Elecode\ExpressionParsing\Expression\Symbol\Operand\Numeric;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Addition;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Division;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Multiplication;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Subtraction;
use Elecode\ExpressionParsing\Expression;

class Parser
{
    private static $operators;

    public static function parseExpression($string)
    {
        $expression = new Expression();
        $arrayOfSymbols = explode(' ', $string);
        foreach ($arrayOfSymbols as $symbol) {
            $expression->add(self::parseSymbol($symbol));
        }
        return $expression;
    }

    public static function parseSymbol($string)
    {
        $symbol = self::getOperator($string);
        if (is_null($symbol)) {
            $symbol = Numeric::fromString($string);
        }
        return $symbol;
    }

    private static function getOperator($string)
    {
        if (is_null(self::$operators)) {
            self::loadOperators();
        }
        foreach (self::$operators as $operator) {
            if ($string == (string) $operator) {
                return $operator;
            }
        }
        return null;
    }

    private static function loadOperators()
    {
        self::$operators = array(
            new Addition(),
            new Subtraction(),
            new Multiplication(),
            new Division(),
        );
    }
}
