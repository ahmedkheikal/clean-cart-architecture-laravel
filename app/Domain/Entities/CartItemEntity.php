<?php

namespace App\Domain\Entities;

use App\Application\DTO\AddItemToCartDTO;
use App\Application\DTO\CartItemDTO;

class CartItemEntity
{
    public ?int $id;
    public int $productId;
    public float $quantity;

    public function __construct(int $productId, float $quantity, ?int $id = null)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->id = $id;
    }
    public static function fromDTO(CartItemDTO $dto)
    {
        return new CartItemEntity($dto->productId, $dto->quantity);
    }
}
