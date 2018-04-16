<?php

namespace Gwo\Recruitment\Cart\Exception;

class ItemNotFoundException extends \OutOfBoundsException
{
    public function __construct(int $index)
    {
        parent::__construct("Item was not found at index: {$index}.");
    }
}
