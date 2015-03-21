<?php

namespace Elecode\ExpressionParsing\Expression\Symbol;

use Elecode\ExpressionParsing\Expression\Symbol;

interface Operator extends Symbol
{
    public function hasPrecedenceOver(Operator $anotherOperator);

    public function operate(Operand $firstOperand, Operand $secondOperand);
}
