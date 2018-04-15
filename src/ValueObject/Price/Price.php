<?php

namespace Gwo\Recruitment\ValueObject\Price;

class Price
{
    private const MINIMUM_VALID_VALUE = 1;
    private $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    private function setValue(int $value): void
    {
        if ($value < self::MINIMUM_VALID_VALUE) {
            throw new InvalidPriceException();
        }
        $this->value = $value;
    }
}
