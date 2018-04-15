<?php

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Entity\Product;
use Gwo\Recruitment\ValueObject\Price\Price;

class Cart
{
    private $items;
    private $totalPrice;

    public function __construct()
    {
        $this->items = [];
        $this->totalPrice = 0;
    }

    public function addProduct(Product $product, int $quantity): self
    {
        $item = new Item($product, $quantity);
        $this->items[] = $item;
        $this->updateTotalPrice();

        return $this;
    }

    public function getItem(int $index): Item
    {
        $this->validateItemExists($index);

        return $this->items[$index];
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice->value();
    }

    private function updateTotalPrice()
    {
        $this->totalPrice = new Price($this->calculateTotalPrice());
    }

    private function calculateTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    private function validateItemExists(int $index): void
    {
        if (!isset($this->items[$index])) {
            throw new ItemNotFoundException($index);
        }
    }
}
