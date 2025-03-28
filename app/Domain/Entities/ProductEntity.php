<?php

namespace App\Domain\Entities;

use App\Application\DTO\DTO;

class ProductEntity extends Entity
{
    public ?int $id;
    public string $name;
    public string $description;
    public float $price;
    public int $quantity;
    public string $image;
    public string $created_at;
    public string $updated_at;

    public static function fromDTO($dto): static
    {
        $product = new self();
        $product->id = $dto->id;
        $product->name = $dto->name;
        $product->description = $dto->description;
        $product->price = $dto->price;
        $product->quantity = $dto->quantity;
        $product->image = $dto->image;
        $product->created_at = $dto->created_at;
        $product->updated_at = $dto->updated_at;
        return $product;
    }   
    public static function fromModel($model): static
    {
        $product = new self();
        $product->id = $model->id;
        $product->name = $model->name;
        $product->description = $model->description;
        $product->price = $model->price;
        $product->quantity = $model->quantity;
        $product->image = $model->image;
        $product->created_at = $model->created_at;
        $product->updated_at = $model->updated_at;
        return $product;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}