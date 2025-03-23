<?php

namespace App\Application\DTO;

class CartItemDTO
{
    public readonly int $productId;
    public readonly float $quantity;

    public function __construct(int $productId, float $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public static function fromRequest(array $data): self
    {
        return new self(
            productId: (int) $data['product_id'],
            quantity: (float) $data['quantity']
        );
    }
} 