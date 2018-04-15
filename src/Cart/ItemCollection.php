<?php

namespace Gwo\Recruitment\Cart;

use Gwo\Recruitment\Entity\Product;

class ItemCollection implements \Countable
{
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function add(Item $item)
    {
        $this->items[] = $item;
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
                array_splice($this->items, $index, 1);
                return;
            }
        }
    }

    public function count(): int
    {
        return \count($this->items);
    }

    private function validateItemExists(int $index): void
    {
        if (!isset($this->items[$index])) {
            throw new ItemNotFoundException($index);
        }
    }

}