<?php

namespace App\Application\Services\Interfaces;

use App\Application\DTO\ProductDTO;

interface ProductServiceInterface
{
    /**
     * Get all products
     * 
     * @return ProductDTO[]
     */
    public function getAllProducts(): array;

    /**
     * Create a product
     * 
     * @param array $data
     * @return ProductDTO
     */
    public function createProduct(array $data): ProductDTO;

    public function getProductById($id): ProductDTO;
    public function updateProduct(array $data, $id);
    public function deleteProduct($id);
    public function checkProductStock($productId, $quantity);

}