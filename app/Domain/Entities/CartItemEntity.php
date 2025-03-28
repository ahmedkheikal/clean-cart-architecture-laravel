<?php

namespace App\Domain\Entities;

use App\Application\DTO\CartItemDTO;
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
        if (!$model instanceof CartItem) {
            throw new \InvalidArgumentException('Model must be an instance of CartItem');
        }
        return new CartItemEntity($model->productId, $model->quantity, $model->id);
    }
}
