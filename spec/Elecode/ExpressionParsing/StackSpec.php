<?php

namespace spec\Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Symbol;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StackSpec extends ObjectBehavior
{
    function it_has_zero_length_initially()
    {
        $this->shouldBeEmpty();
    }

    function its_length_changes_when_new_symbol_is_pushed(Symbol $symbol)
    {
        $this->push($symbol);
        $this->length()->shouldBe(1);
    }

    function it_pops_symbol_off_the_top(Symbol $oneSymbol, Symbol $anotherSymbol)
    {
        $this->push($oneSymbol);
        $this->push($anotherSymbol);
        $this->pop()->shouldReturn($anotherSymbol);
    }
}
