<?php

namespace Gwo\Recruitment\Cart\Exception;

class QuantityTooLowException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Item quantity cannot be lower than product minimum quantity.');
    }
}
