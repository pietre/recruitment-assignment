<?php

namespace Gwo\Recruitment\ValueObject\Price;

class InvalidPriceException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Price needs to be non-negative integer.');
    }
}
