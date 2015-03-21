<?php

namespace spec\Elecode\ExpressionParsing\Expression\Symbol\Operator;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use PhpSpec\ObjectBehavior;
use Elecode\ExpressionParsing\Expression\Symbol\Operand\Numeric;
use Prophecy\Argument;

class SubtractionSpec extends ObjectBehavior
{
    function it_is_operator()
    {
        $this->shouldHaveType('Elecode\ExpressionParsing\Expression\Symbol\Operator');
    }

    function it_operate_on_two_numbers(Operand $firstOperand, Operand $secondOperand)
    {
        $firstOperand->getValue()->willReturn(3);
        $secondOperand->getValue()->willReturn(1);
        $result = $this->operate($firstOperand, $secondOperand);
        $result->shouldReturn(2);
    }

    function it_has_string_representation()
    {
        $this->__toString()->shouldReturn('-');
    }
}
