<?php

namespace spec\Elecode\ExpressionParsing\Expression;

use Elecode\ExpressionParsing\Expression\Symbol\Operand\Numeric;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Addition;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Division;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Multiplication;
use Elecode\ExpressionParsing\Expression\Symbol\Operator\Subtraction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserSpec extends ObjectBehavior
{
    function it_return_numeric_operand()
    {
        $this::parseSymbol('1')->shouldBeLike(Numeric::fromString('1'));
    }

    function it_returns_addition()
    {
        $this->parseSymbol('+')->shouldBeLike(new Addition());
    }

    function it_returns_subtraction()
    {
        $this->parseSymbol('-')->shouldBeLike(new Subtraction());
    }

    function it_returns_multiplication()
    {
        $this->parseSymbol('*')->shouldBeLike(new Multiplication());
    }

    function it_returns_division()
    {
        $this->parseSymbol('/')->shouldBeLike(new Division());
    }

    function it_parses_sequence_of_numbers_with_known_operators()
    {
        $expression = $this->parseExpression('2 3 4 * +');
        $expression->getSequence()->shouldBeLike(
            array(
                Numeric::fromString('2'),
                Numeric::fromString('3'),
                Numeric::fromString('4'),
                new Multiplication(),
                new Addition(),
            )
        );
    }
}
