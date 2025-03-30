<?php

namespace App\Domain\Entities;

use App\Infrastructure\Persistance\Models\Cart;
class CartEntity extends Entity
{
    /**
     * @var CartItemEntity[]
     */
    public array $items; // array of CartItemEntity
    public ?float $totalPrice; // nullable for newly created cart
    public ?int $totalQuantity; // nullable for newly created cart
    public ?int $id; // nullable for create cart entity
    public function __construct(array $items, ?float $totalPrice, ?int $totalQuantity, ?int $id = null)
    {
        $this->items = $items; // if items are plain array of productIds, convert to CartItemEntity
        if (is_array($items) && !empty($items) && is_array($items[0])) {
            $this->setItemsFromArray($items);
        }
        $this->totalPrice = $totalPrice;
        $this->totalQuantity = $totalQuantity;
        $this->id = $id;
    }
    private function setItemsFromArray(array $items)
    {
        $this->items = [];
        foreach ($items as $item) {
            $this->items[] = CartItemEntity::fromArray($item);
        }
    }
    public static function fromDTO($dto): static
    {
        if (!$dto instanceof CartDTO) {
            throw new \InvalidArgumentException('DTO must be an instance of CartDTO');
        }
        return new CartEntity($dto->items, $dto->totalPrice, $dto->totalQuantity);
    }
    public static function fromModel($model): static
    {
        if (!$model instanceof Cart) {
            throw new \InvalidArgumentException('Model must be an instance of Cart');
        }
        $items = [];
        foreach ($model->products as $product) {
            // pass 
            $items[] = CartItemEntity::fromModel($product);
        }
        return new CartEntity($items, $model->totalPrice, $model->totalQuantity, $model->id);
    }
    public function isValid(): bool
    {
        // validate stock of each item
        foreach ($this->items as $item) {
            if ($item->quantity <= 0) {
                return false;
            }
        }
        return true;
    }
    public function canCheckout(): bool
    {
        return $this->isValid() && $this->totalQuantity > 0;
    }
    public function toArray(): array
    {
        return [
            'items' => array_map(function($item) {
                return is_array($item) ? $item : $item->toArray();
            }, $this->items),
            'totalPrice' => $this->totalPrice,
            'totalQuantity' => $this->totalQuantity,
            'id' => $this->id,
        ];
    }
}
