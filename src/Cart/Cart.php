<?php

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Entity\Product;
use Gwo\Recruitment\ValueObject\Price\Price;

class Cart
{
    private const DEFAULT_TOTAL_PRICE = 0;

    private $items;
    private $totalPrice;

    public function __construct()
    {
        $this->items = new ItemCollection();
        $this->totalPrice = new Price(self::DEFAULT_TOTAL_PRICE);
    }

    public function addProduct(Product $product, $quantity): self
    {
        $item = new Item($product, $quantity);
        $this->items->add($item);
        $this->updateTotalPrice();

        return $this;
    }

    public function removeProduct(Product $product): void
    {
        $this->items->removeByProduct($product);
        $this->updateTotalPrice();
    }

    public function setQuantity(Product $product, int $quantity): void
    {
        $item = new Item($product, $quantity);
        $this->items->update($item);
        $this->updateTotalPrice();
    }

    public function getItem(int $itemIndex): Item
    {
        return $this->items->get($itemIndex);
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice->value();
    }

    private function updateTotalPrice(): void
    {
        $this->totalPrice = new Price($this->calculateTotalPrice());
    }

    private function calculateTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->items->toArray() as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }
}
