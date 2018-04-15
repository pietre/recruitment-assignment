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
        $this->items = new ItemCollection();
        $this->totalPrice = 0;
    }

    public function addProduct(Product $product, int $quantity): self
    {
        $item = new Item($product, $quantity);
        $this->items->add($item);
        $this->updateTotalPrice();

        return $this;
    }

    public function removeProduct(Product $product)
    {
        $this->items->removeProduct($product);
        $this->updateTotalPrice();
    }

    public function getItem(int $index): Item
    {
        return $this->items->get($index);
    }

    public function getItems(): ItemCollection
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
}
