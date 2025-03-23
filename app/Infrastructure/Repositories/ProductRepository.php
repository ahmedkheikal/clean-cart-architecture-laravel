<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\ProductRepositoryInterface;
use App\Infrastructure\Persistance\Models\Product;
use App\Application\DTO\ProductDTO;
class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts() : array
    {
        return Product::all()->map(function($product) {
            return new ProductDTO($product);
        })->all();
    }

    /**
     * Get product by ID
     * 
     * @param int $id
     * @return Product|null
     */
    public function getProductById($id) : ProductDTO 
    {
        return new ProductDTO(Product::find($id));
    }

    /**
     * Create a new product
     * 
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data) : ProductDTO
    {
        return new ProductDTO(Product::create($data));
    }

    /**
     * Update an existing product
     * 
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateProduct(array $data, $id) : ProductDTO
    {
        $product = $this->getProductById($id);
        if ($product) {
            return new ProductDTO($product->update($data));
        }
        throw new \Exception('Product not found');
    }

    /**
     * Delete a product
     * 
     * @param int $id
     * @return bool
     */
    public function deleteProduct($id) : bool
    {
        $product = $this->getProductById($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}