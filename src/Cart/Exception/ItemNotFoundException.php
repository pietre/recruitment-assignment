<?php

namespace Gwo\Recruitment\Cart\Exception;

class ItemNotFoundException extends \OutOfBoundsException
{
    public function __construct(int $index)
    {
        parent::__construct("No item found at index: {$index}.");
    }
}
