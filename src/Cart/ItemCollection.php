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

    public function add(Item $item): void
    {
        foreach ($this->items as $existingItem) {
            if ($item->getProduct()->equals($existingItem->getProduct())) {
                $existingItem->setQuantity($item->getQuantity() + $existingItem->getQuantity());

                return;
            }
        }
        $this->items[] = $item;
    }

    public function get(int $itemIndex): Item
    {
        $this->validateItemExists($itemIndex);

        return $this->items[$itemIndex];
    }

    public function update(Item $item): void
    {
        foreach ($this->items as $existingItem) {
            if ($item->getProduct()->equals($existingItem->getProduct())) {
                $existingItem->setQuantity($item->getQuantity());

                return;
            }
        }
        $this->items[] = $item;
    }

    public function removeByProduct(Product $product): void
    {
        foreach ($this->items as $index => $existingItem) {
            if ($product->equals($existingItem->getProduct())) {
                $this->removeFromIndex($index);

                return;
            }
        }
    }

    public function count()
    {
        return \count($this->items);
    }

    public function toArray()
    {
        return $this->items;
    }

    private function validateItemExists(int $itemIndex): void
    {
        if (!isset($this->items[$itemIndex])) {
            throw new ItemNotFoundException($itemIndex);
        }
    }

    private function removeFromIndex(int $index): void
    {
        \array_splice($this->items, $index, 1);
    }
}
