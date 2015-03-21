<?php

namespace Elecode\ExpressionParsing\Expression\Symbol\Operand;

use Elecode\ExpressionParsing\Expression\Symbol\Operand;

class Numeric implements Operand
{
    private $value;

    public static function fromString($string)
    {
        $value = (int) $string;
        $number = new Numeric($value);

        return $number;
    }

    private function __construct($value)
    {
        $this->value = (int) $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
