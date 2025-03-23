<?php

namespace App\Application\DTO;

use App\Domain\Entities\CartEntity;
class CartDTO
{
    public $items;
    public $totalPrice;
    public $totalQuantity;

    public function __construct($items, $totalPrice, $totalQuantity)
    {   
        $this->items = $items;
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
    }
    public static function fromEntity(CartEntity $cartEntity)
    {
        $items = [];
        foreach ($cartEntity->items as $item) {
            $items[] =  new CartItemDTO($item->productId, $item->quantity);
        }
        return new CartDTO($items, $cartEntity->totalPrice, $cartEntity->totalQuantity);
    }
    public static function fromArray(array $data)
    {
        $items = [];
        foreach ($data['items'] as $item) {
            $items[] = new CartItemDTO($item['productId'], $item['quantity']);
        }
        return new CartDTO($items, $data['totalPrice'], $data['totalQuantity']);
    }
}