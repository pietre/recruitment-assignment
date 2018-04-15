<?php

namespace Gwo\Recruitment\Entity;

use Gwo\Recruitment\ValueObject\Price\Price;
use Gwo\Recruitment\ValueObject\Quantity\Quantity;

class Product
{
    private const DEFAULT_MINIMUM_QUANTITY = 1;
    private const DEFAULT_UNIT_PRICE = 1;

    private $id;
    private $minimumQuantity;
    private $unitPrice;

    public function __construct()
    {
        $this->setMinimumQuantity(self::DEFAULT_MINIMUM_QUANTITY);
        $this->setUnitPrice(self::DEFAULT_UNIT_PRICE);
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setMinimumQuantity(int $minimumQuantity): self
    {
        $this->minimumQuantity = new Quantity($minimumQuantity);

        return $this;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = new Price($unitPrice);

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity->value();
    }

    public function getUnitPrice(): int
    {
        return $this->unitPrice->value();
    }
}
