<?php

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Cart\Exception\ItemNotFoundException;
use Gwo\Recruitment\Entity\Product;

class ItemCollection implements \Countable
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(Item $addedItem)
    {
        foreach ($this->items as $index => $existingItem) {
            if ($addedItem->getProduct()->equals($existingItem->getProduct())) {
                $existingItem->setQuantity($existingItem->getQuantity() + $addedItem->getQuantity());
                return;
            }
        }

        $this->items[] = $addedItem;
    }

    public function get(int $index): Item
    {
        $this->validateItemExists($index);

        return $this->items[$index];
    }

    public function removeProduct(Product $product): void
    {
        foreach ($this->items as $index => $item) {
            if ($product->equals($item->getProduct())) {
                $this->removeFromIndex($index);
                return;
            }
        }
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function getTotalPrice(): int
    {
        $totalPrice = 0;
        foreach ($this->items as $item) {
            $totalPrice += $item->getTotalPrice();
        }

        return $totalPrice;
    }

    public function setProductQuantity(Product $product, int $quantity)
    {
        foreach ($this->items as $index => $item) {
            if ($product->equals($item->getProduct())) {
                $item->setQuantity($quantity);

                return;
            }
        }
    }

    private function validateItemExists(int $index): void
    {
        var_dump($index);
        if (!isset($this->items[$index])) {
            throw new ItemNotFoundException($index);
        }
    }

    private function removeFromIndex($index): array
    {
        return array_splice($this->items, $index, 1);
    }

}