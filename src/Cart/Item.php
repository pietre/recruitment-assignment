<?php

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Cart\Exception\QuantityTooLowException;
use Gwo\Recruitment\Entity\Product;
use Gwo\Recruitment\ValueObject\Price\Price;
use Gwo\Recruitment\ValueObject\Quantity\Quantity;

class Item
{
    private $product;
    private $quantity;
    private $totalPrice;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->setQuantity($quantity);
    }

    public function setQuantity(int $quantity): self
    {
        $this->validateQuantity($quantity);
        $this->quantity = new Quantity($quantity);
        $this->updateTotalPrice();

        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity->value();
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice->value();
    }

    private function validateQuantity(int $quantity): void
    {
        if ($quantity < $this->product->getMinimumQuantity()) {
            throw new QuantityTooLowException();
        }
    }

    private function updateTotalPrice(): void
    {
        $this->totalPrice = new Price($this->calculateTotalPrice());
    }

    private function calculateTotalPrice(): int
    {
        return $this->quantity->value() * $this->product->getUnitPrice();
    }
}
