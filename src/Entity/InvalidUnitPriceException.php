<?php

namespace Gwo\Recruitment\Entity;

class InvalidUnitPriceException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Product unit price needs to be positive integer.');
    }
}
