<?php

namespace App\Domain\Entities;

use App\Infrastructure\Persistance\Models\Cart;
class CartEntity extends Entity
{
    /**
     * @var CartItemEntity[]
     */
    public array $items; // array of CartItemEntity
    public float $totalPrice;
    public int $totalQuantity;
    public int $id;
    public function __construct(array $items, float $totalPrice, int $totalQuantity, int $id = null)
    {
        $this->items = $items;
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
        $this->id = $id;
    }
    public static function fromDTO($dto) : static
    {
        if (!$dto instanceof CartDTO) {
            throw new \InvalidArgumentException('DTO must be an instance of CartDTO');
        }
        return new CartEntity($dto->items, $dto->totalPrice, $dto->totalQuantity);
    }
    public static function fromModel($model) : static
    {
        if (!$model instanceof Cart) {
            throw new \InvalidArgumentException('Model must be an instance of Cart');
        }
        $items = [];
        foreach ($model->products as $product) {
            $items[] = CartItemEntity::fromModel($product);
        }
        return new CartEntity($items, $model->totalPrice, $model->totalQuantity, $model->id);
    }
    public function isValid() : bool
    {
        // validate stock of each item
        foreach ($this->items as $item) {
            if ($item->quantity <= 0) {
                return false;
            }
        }   
        return true;
    }
    public function canCheckout() : bool
    {
        return $this->isValid() && $this->totalQuantity > 0;
    }
    }
