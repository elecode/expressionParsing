<?php

namespace spec\Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression;
use Elecode\ExpressionParsing\Expression\Symbol\Operand;
use Elecode\ExpressionParsing\Expression\Symbol\Operator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InfixConverterSpec extends ObjectBehavior
{
    function it_converts_simple_infix_sum_to_postfix()
    {
        $this->toPostfixString('1 + 1')->shouldReturn('1 1 +');
    }

    function it_converts_two_consequent_infix_sums_to_postfix()
    {
        $this->toPostfixString('1 + 2 + 3')->shouldReturn('1 2 + 3 +');
    }

    function it_converts_sequence_of_infix_operations_with_decreasing_precedence_to_postfix()
    {
        $this->toPostfixString('2 * 3 + 4')->shouldReturn('2 3 * 4 +');
    }

    function it_converts_sequence_of_infix_operations_with_increasing_precedence_to_postfix()
    {
        $this->toPostfixString('2 + 3 * 4')->shouldReturn('2 3 4 * +');
    }

    function it_converts_complex_sequence_of_infix_operations_to_postfix()
    {
        $this->toPostfixString('2 + 3 * 4 - 7 + 3 / 3')->shouldReturn('2 3 4 * + 7 - 3 3 / +');
    }

    function it_converts_infix_expression_to_pastfix_expression(
        Expression $infixExpression,
        Operand $firstOperand,
        Operator $operator,
        Operand $secondOperand
    )
    {
        $infixExpression->getSequence()->willReturn(
            array(
                $firstOperand,
                $operator,
                $secondOperand
            )
        );
        $postfixExpression = $this->toPostfix($infixExpression);
        $postfixExpression->shouldHaveType(Expression::class);
        $postfixExpression->getSequence()->shouldBe(
            array(
                $firstOperand,
                $secondOperand,
                $operator
            )
        );
    }
}
