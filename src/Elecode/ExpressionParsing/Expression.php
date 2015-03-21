<?php

namespace Elecode\ExpressionParsing;

class Expression
{
    private $sequence = array();

    public function __construct()
    {
        call_user_func_array(array($this, 'add'), func_get_args());
    }

    public function add()
    {
        $itemsToBeAdded = func_get_args();
        $this->sequence = array_merge($this->sequence, $itemsToBeAdded);
    }

    public function getSequence()
    {
        return $this->sequence;
    }

    public function __toString()
    {
        return implode(' ', $this->sequence);
    }
}
