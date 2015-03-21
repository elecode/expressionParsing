<?php

namespace Elecode\ExpressionParsing\Expression\Symbol;

use Elecode\ExpressionParsing\Expression\Symbol;

interface Operand extends Symbol
{
    public static function fromString($string);

    public function getValue();
}
