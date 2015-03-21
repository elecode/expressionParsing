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
        $operands = new Stack();
        foreach ($expression->getSequence() as $symbol) {
            if ($symbol instanceof Operand) {
                $operands->push($symbol);
            } else if ($symbol instanceof Operator) {
                $secondOperand = $operands->pop();
                $firstOperand = $operands->pop();
                $result = $symbol->operate($firstOperand, $secondOperand);
                $operands->push(Parser::parseSymbol($result));
            }
        }
        return $operands->pop();
    }
}
