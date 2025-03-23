<?php

namespace App\Domain\Entities;

class CartEntity
{
    /**
     * @var CartItemEntity[]
     */
    public array $items; // array of CartItemEntity
    public float $totalPrice;
    public int $totalQuantity;

    public function __construct()
    {
        $this->items = [];
        $this->totalPrice = 0;
        $this->totalQuantity = 0;
    }
}
