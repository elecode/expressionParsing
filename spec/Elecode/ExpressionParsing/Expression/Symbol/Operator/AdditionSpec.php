<?php

namespace spec\Elecode\ExpressionParsing\Expression\Symbol\Operator;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdditionSpec extends ObjectBehavior
{
    function it_is_operator()
    {
        $this->shouldHaveType('Elecode\ExpressionParsing\Expression\Symbol\Operator');
    }

    function it_operate_on_two_operands(
        Operand $firstOperand,
        Operand $secondOperand
    )
    {
        $firstOperand->getValue()->willReturn(1);
        $secondOperand->getValue()->willReturn(2);
        $result = $this->operate($firstOperand, $secondOperand);
        $result->shouldReturn(3);
    }

    function it_has_numeric_representation()
    {
        $this->__toString()->shouldReturn('+');
    }
}
