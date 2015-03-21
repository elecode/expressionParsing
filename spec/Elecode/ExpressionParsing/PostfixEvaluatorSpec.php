<?php

namespace spec\Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression;
use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PostfixEvaluatorSpec extends ObjectBehavior
{
    function it_evaluates_single_number()
    {
        $this->evaluateString('3')->shouldReturn('3');
    }

    function it_evaluates_sum_of_two_numbers()
    {
        $this->evaluateString('3 2 +')->shouldReturn('5');
    }

    function it_evaluates_subtraction_of_two_numbers()
    {
        $this->evaluateString('3 2 -')->shouldReturn('1');
    }

    function it_evaluates_multiplication_of_two_numbers()
    {
        $this->evaluateString('2 3 *')->shouldReturn('6');
    }

    function it_evaluates_simple_division()
    {
        $this->evaluateString('6 3 /')->shouldReturn('2');
    }

    function it_evaluates_sequence_of_sums_of_numbers()
    {
        $this->evaluateString('1 2 + 3 + 4 +')->shouldReturn('10');
    }

    function it_evaluates_sequence_of_mixed_operations_on_numbers()
    {
        $this->evaluateString('1 2 + 3 + 4 + 10 + 12 -')->shouldReturn('8');
    }

    function it_evaluates_complex_sequence_of_operations_on_numbers()
    {
        $this->evaluateString('2 3 4 * + 7 - 3 3 / +')->shouldReturn('8');
    }

    function it_evaluates_expression(
        Expression $expression,
        Operand $firstOperand,
        Operand $secondOperand,
        Operator $operator
    )
    {
        $operator->operate($firstOperand, $secondOperand)->willReturn(9);
        $expression->getSequence()->willReturn(array($firstOperand, $secondOperand, $operator));

        $evaluation = $this->evaluate($expression);
        $evaluation->shouldImplement(Operand::class);
        $evaluation->getValue()->shouldReturn(9);
    }
}
