<?php

namespace spec\Elecode\ExpressionParsing\Expression\Symbol\Operand;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NumericSpec extends ObjectBehavior
{
    function it_is_operand()
    {
        $this->shouldHaveType('Elecode\ExpressionParsing\Expression\Symbol\Operand');
    }

    function its_value_is_an_integer()
    {
        $this->beConstructedThrough("fromString", ["4"]);
        $this->getValue()->shouldReturn(4);
    }

    function it_has_string_representation()
    {
        $this->beConstructedThrough("fromString", ["5"]);
        $this->__toString()->shouldReturn("5");
    }
}
