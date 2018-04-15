<?php

namespace Gwo\Recruitment\Cart;

class ItemNotFoundException extends \OutOfBoundsException
{
    public function __construct(int $index)
    {
        parent::__construct("No item found at index: {$index}.");
    }
}
