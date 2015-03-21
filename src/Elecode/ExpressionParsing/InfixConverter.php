<?php

namespace Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use Elecode\ExpressionParsing\Expression\Parser;

class InfixConverter
{
    public function toPostfix(Expression $infixExpression)
    {
        $postfixExpression = new Expression();
        $stackOfOperators = array();
        foreach ($infixExpression->getSequence() as $element) {
            if ($element instanceof Operand) {
                $postfixExpression->add($element);
            } elseif (!count($stackOfOperators)) {
                array_push($stackOfOperators, $element);
            } else {
                /** @var Operator $oldOperator */
                for (
                    $oldOperator = array_pop($stackOfOperators);
                    $oldOperator instanceof Operator;
                    $oldOperator = array_pop($stackOfOperators)
                ) {
                    /** @var Operator $element */
                    if ($element->hasPrecedenceOver($oldOperator)) {
                        array_push($stackOfOperators, $oldOperator);
                        array_push($stackOfOperators, $element);
                        break;
                    } else {
                        $postfixExpression->add($oldOperator);
                        if (!count($stackOfOperators)) {
                            array_push($stackOfOperators, $element);
                            break;
                        }
                    }
                }
            }
        }
        for (
            $operator = array_pop($stackOfOperators);
            $operator instanceof Operator;
            $operator = array_pop($stackOfOperators)
        ) {
            $postfixExpression->add($operator);
        }
        return $postfixExpression;
    }

    public function toPostfixString($string)
    {
        $infixExpression = Parser::parseExpression($string);
        return (string) $this->toPostfix($infixExpression);
    }
}
