<?php

namespace App\Application\DTO;

class ProductDTO
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
}