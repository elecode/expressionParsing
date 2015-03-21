<?php

namespace Elecode\ExpressionParsing\Expression\Symbol\Operator;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;

class Subtraction implements Operator
{
    public function hasPrecedenceOver(Operator $anotherOperator)
    {
        return false;
    }

    public function operate(Operand $firstOperand, Operand $secondOperand)
    {
        return $firstOperand->getValue() - $secondOperand->getValue();
    }

    public function __toString()
    {
        return '-';
    }
}
