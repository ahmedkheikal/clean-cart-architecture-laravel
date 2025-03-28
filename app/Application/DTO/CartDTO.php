<?php

namespace App\Application\DTO;

use App\Domain\Entities\CartEntity;
use App\Domain\Entities\Entity;
use Illuminate\Http\Request;
class CartDTO extends DTO
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
    public static function fromArray(array $data) : static
    {
        $items = [];
        foreach ($data['items'] as $item) {
            $items[] = new CartItemDTO($item['productId'], $item['quantity']);
        }
        return new CartDTO($items, $data['totalPrice'], $data['totalQuantity']);
    }
    public static function fromRequest(Request $request) : static
    {
        $items = [];
        foreach ($request->items as $item) {
            $items[] = CartItemDTO::fromRequest($item);
        }
        return new CartDTO($items, $request->totalPrice, $request->totalQuantity);
    }
    public static function fromEntity(Entity $entity) : static
    {
        if (!$entity instanceof CartEntity) {
            throw new \InvalidArgumentException('Entity must be an instance of CartEntity');
        }
        $items = [];
        foreach ($entity->items as $item) {
            $items[] = CartItemDTO::fromEntity($item);
        }
        return new CartDTO($items, $entity->totalPrice, $entity->totalQuantity);
    }
}