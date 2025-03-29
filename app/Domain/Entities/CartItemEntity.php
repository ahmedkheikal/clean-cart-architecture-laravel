<?php

namespace App\Domain\Entities;

use App\Application\DTO\CartItemDTO;
use App\Infrastructure\Persistance\Models\Product;
class CartItemEntity extends Entity
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
    public static function fromDTO($dto) : static
    {
        if (!$dto instanceof CartItemDTO) {
            throw new \InvalidArgumentException('DTO must be an instance of CartItemDTO');
        }
        return new CartItemEntity($dto->productId, $dto->quantity);
    }
    public static function fromModel($model) : static
    {
        if (!$model instanceof Product) {
            throw new \InvalidArgumentException('Model must be an instance of Product');
        }
        $quantity = $model->pivot->quantity;
        return new CartItemEntity($model->id, $quantity);
    }
    public function toArray() : array
    {
        return [
            'productId' => $this->productId,
            'quantity' => $this->quantity
        ];
    }
    public static function fromArray(array $array) : static
    {
        if (!array_key_exists('productId', $array) || !array_key_exists('quantity', $array)) {
            throw new \InvalidArgumentException('Array must contain productId and quantity');
        }
        return new CartItemEntity($array['productId'], $array['quantity']);
    }
}
