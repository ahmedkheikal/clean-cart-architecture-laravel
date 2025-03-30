<?php

namespace App\Application\DTO;

use App\Domain\Entities\CartItemEntity;
use Illuminate\Http\Request;
use App\Domain\Entities\Entity;
class CartItemDTO extends DTO
{
    public readonly int $productId;
    public readonly float $quantity;
    public readonly string $productName;
    public readonly float $unitPrice;
    public function __construct(int $productId, float $quantity, string $productName, float $unitPrice)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->productName = $productName;
        $this->unitPrice = $unitPrice;
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            productId: (int) $request->product_id,
            quantity: (float) $request->quantity,
            productName: '',
            unitPrice: (float) $request->unit_price
        );
    }

    public static function fromArray(array $data): static
    {
        return new self(
            productId: $data['productId'],
            quantity: $data['quantity'],
            productName: $data['productName'],
            unitPrice: $data['unitPrice']
        );
    }
    public static function fromEntity(Entity $entity): static
    {
        if (!$entity instanceof CartItemEntity) {
            throw new \InvalidArgumentException('Entity must be an instance of CartItemEntity');
        }
        return new self(
            productId: $entity->productId,
            quantity: $entity->quantity,
            productName: $entity->productName,
            unitPrice: $entity->unitPrice
        );
    }
    public function toArray(): array
    {
        return [
            'productId' => $this->productId,
            'quantity' => $this->quantity,
            'productName' => $this->productName,
            'unitPrice' => $this->unitPrice
        ];
    }
} 