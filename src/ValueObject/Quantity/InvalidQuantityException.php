<?php

namespace Gwo\Recruitment\ValueObject\Quantity;

class InvalidQuantityException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Quantity needs to be positive integer.');
    }
}
