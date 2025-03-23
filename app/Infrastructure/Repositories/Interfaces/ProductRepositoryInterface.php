<?php

namespace App\Infrastructure\Repositories\Interfaces;

use App\Application\DTO\ProductDTO;
interface ProductRepositoryInterface
{
    /**
     * returns ProductDTO[]
     */
    public function getAllProducts(): array;
    /**
     * returns ProductDTO
     */
    public function getProductById($id): ProductDTO;
    /**
     * returns ProductDTO
     */
    public function createProduct(array $data): ProductDTO;
    /**
     * returns ProductDTO
     */
    public function updateProduct(array $data, $id): ProductDTO;
    /**
     * returns bool
     */
    public function deleteProduct($id): bool;
}