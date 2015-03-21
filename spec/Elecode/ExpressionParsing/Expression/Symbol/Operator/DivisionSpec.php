<?php

namespace spec\Elecode\ExpressionParsing\Expression\Symbol\Operator;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Addition;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Subtraction;
use PhpSpec\ObjectBehavior;
use Elecode\ExpressionParsing\Expression\Symbol\Operand\Numeric;
use Prophecy\Argument;

class DivisionSpec extends ObjectBehavior
{
    function it_is_operator()
    {
        $this->shouldHaveType('Elecode\ExpressionParsing\Expression\Symbol\Operator');
    }

    function it_operate_on_two_numbers(Operand $firstOperand, Operand $secondOperand)
    {
        $firstOperand->getValue()->willReturn(6);
        $secondOperand->getValue()->willReturn(2);
        $result = $this->operate($firstOperand, $secondOperand);
        $result->shouldReturn(3);
    }

    public function it_has_string_representation()
    {
        $this->__toString()->shouldReturn('/');
    }

    public function it_has_precedence_over_addition()
    {
        $this->shouldHavePrecedenceOver(new Addition());
    }

    public function it_has_precedence_over_subtraction()
    {
        $this->shouldHavePrecedenceOver(new Subtraction());
    }
}
