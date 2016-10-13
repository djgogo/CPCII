<?php
declare(strict_types = 1);

class ShoppingCart
{
    /**
     * @var UUID
     */
    private $id;

    /**
     * @var array
     */
    private $items;

    public function __construct(UUID $id)
    {
        $this->id = $id;
    }

    public function getId() : string
    {
        return (string) $this->id;
    }

    public function addItem(ShoppingCartItemInterface $item)
    {
        $this->items[] = $item;
    }

    public function removeItem(ShoppingCartItemInterface $item)
    {
        foreach ($this->items as $index => $current) {
            if ($item === $current) {
                unset($this->items[$index]);
                break;
            }
        }
    }

    public function getItems() : array
    {
        return $this->items;
    }

    public function getTotal() : int
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        return $total;
    }
}

