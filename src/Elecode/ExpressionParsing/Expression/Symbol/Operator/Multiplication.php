<?php

namespace Elecode\ExpressionParsing\Expression\Symbol\Operator;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;

class Multiplication implements Operator
{
    public function hasPrecedenceOver(Operator $anotherOperator)
    {
        if ($anotherOperator instanceof Addition) {
            return true;
        } else if ($anotherOperator instanceof Subtraction) {
            return true;
        }
        return false;
    }

    public function operate(Operand $firstOperand, Operand $secondOperand)
    {
        return $firstOperand->getValue() * $secondOperand->getValue();
    }

    public function __toString()
    {
        return '*';
    }
}
