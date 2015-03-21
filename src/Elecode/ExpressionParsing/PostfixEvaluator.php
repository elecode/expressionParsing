<?php

namespace Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Parser;
use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use Elecode\ExpressionParsing\Expression\Parser as ExpressionParser;
use Elecode\ExpressionParsing\Expression;

class PostfixEvaluator
{
    public function evaluateString($string)
    {
        $expression = ExpressionParser::parseExpression($string);
        return (string) $this->evaluate($expression);
    }

    public function evaluate(Expression $expression)
    {
        $stackOfOperands = array();
        foreach ($expression->getSequence() as $element) {
            if ($element instanceof Operand) {
                array_push($stackOfOperands, $element);
            } else if ($element instanceof Operator) {
                $otherNumber = array_pop($stackOfOperands);
                $oneNumber = array_pop($stackOfOperands);
                array_push($stackOfOperands, Parser::parseSymbol($element->operate($oneNumber, $otherNumber)));
            }
        }
        return array_pop($stackOfOperands);
    }
}
