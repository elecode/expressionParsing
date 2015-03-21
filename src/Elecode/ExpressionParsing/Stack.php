<?php

namespace Elecode\ExpressionParsing;

use Elecode\ExpressionParsing\Expression\Symbol;

class Stack
{
    private $stack = array();

    public function push(Symbol $symbol)
    {
        array_push($this->stack, $symbol);
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function length()
    {
        return count($this->stack);
    }

    public function isEmpty()
    {
        return $this->length() == 0;
    }
}
