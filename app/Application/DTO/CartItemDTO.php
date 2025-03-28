<?php

namespace App\Application\DTO;

use Illuminate\Http\Request;
use App\Domain\Entities\Entity;
class CartItemDTO extends DTO
{
    public readonly int $productId;
    public readonly float $quantity;

    public function __construct(int $productId, float $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            productId: (int) $request->product_id,
            quantity: (float) $request->quantity
        );
    }
    public static function fromArray(array $data): static
    {
        return new self(
            productId: $data['product_id'],
            quantity: $data['quantity']
        );
    }
    public static function fromEntity(Entity $entity): static
    {
        if (!$entity instanceof CartItemEntity) {
            throw new \InvalidArgumentException('Entity must be an instance of CartItemEntity');
        }
        return new self(
            productId: $entity->productId,
            quantity: $entity->quantity
        );
    }
} 