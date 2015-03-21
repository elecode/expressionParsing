<?php

namespace spec\Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExpressionSpec extends ObjectBehavior
{
    function it_has_a_sequence_of_symbols(Operand $firstOperand, Operator $operator, Operand $secondOperand)
    {
        $this->add($firstOperand, $operator, $secondOperand);
        $this->getSequence()->shouldReturn(
            array(
                $firstOperand,
                $operator,
                $secondOperand
            )
        );
    }

    function it_can_be_constructed_with_a_sequence_of_symbols(
        Operand $firstOperand, Operator $operator, Operand $secondOperand
    )
    {
        $this->beConstructedWith($firstOperand, $operator, $secondOperand);
        $this->getSequence()->shouldReturn(
            array(
                $firstOperand,
                $operator,
                $secondOperand
            )
        );
    }

    function it_has_string_representation(Operand $firstOperand, Operator $operator, Operand $secondOperand)
    {
        $firstOperand->__toString()->willReturn("4");
        $operator->__toString()->willReturn("+");
        $secondOperand->__toString()->willReturn("5");
        $this->add($firstOperand, $operator, $secondOperand);
        $this->__toString()->shouldReturn("4 + 5");
    }
}
