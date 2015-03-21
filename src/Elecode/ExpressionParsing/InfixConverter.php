<?php

namespace Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Symbol;
use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use Elecode\ExpressionParsing\Expression\Parser;

class InfixConverter
{
    public function toPostfixString($string)
    {
        $infixExpression = Parser::parseExpression($string);
        return (string) $this->toPostfix($infixExpression);
    }

    public function toPostfix(Expression $infixExpression)
    {
        $postfixExpression = new Expression();
        $operators = new Stack();
        foreach ($infixExpression->getSequence() as $symbol) {
            if ($symbol instanceof Operand) {
                $postfixExpression->add($symbol);
            } else {
                $this->handleOperator($postfixExpression, $operators, $symbol);
            }
        }
        $this->addAllRemainingStackOperators($postfixExpression, $operators);
        return $postfixExpression;
    }

    private function handleOperator(Expression $expression, Stack $operators, Operator $operator)
    {
        if (!$operators->isEmpty()) {
            $this->addAllOperatorsWithNotLowerPrecedence($expression, $operators, $operator);
        }
        $operators->push($operator);
    }

    private function addAllOperatorsWithNotLowerPrecedence(Expression $expression, Stack $operators, Operator $operator)
    {
        for ($stackOperator = $operators->pop(); !is_null($stackOperator); $stackOperator = $operators->pop()) {
            if ($operator->hasPrecedenceOver($stackOperator)) {
                $operators->push($stackOperator);
                break;
            } else {
                $expression->add($stackOperator);
            }
        }
    }

    private function addAllRemainingStackOperators(Expression $expression, Stack $operators)
    {
        for ($operator = $operators->pop(); !is_null($operator); $operator = $operators->pop()) {
            $expression->add($operator);
        }
    }
}
