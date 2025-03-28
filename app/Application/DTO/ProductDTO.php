<?php

namespace App\Application\DTO;

use Illuminate\Http\Request;
use App\Domain\Entities\Entity;
class ProductDTO extends DTO
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $image;
    public $stock_balance;
    public $created_at;
    public $updated_at;

    public function __construct($product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->image = $product->image;
        $this->stock_balance = $product->stock_balance;
        $this->created_at = $product->created_at;
        $this->updated_at = $product->updated_at;
    }
    public static function fromArray(array $data): static
    {
        return new self($data);
    }

    public static function fromRequest(Request $request): static
    {
        return new self($request->all());
    }
    public static function fromEntity(Entity $entity): static
    {
        if (!$entity instanceof ProductEntity) {
            throw new \InvalidArgumentException('Entity must be an instance of ProductEntity');
        }
        return new self($entity->toArray());
    }
}