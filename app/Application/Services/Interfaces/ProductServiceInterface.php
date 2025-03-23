<?php

namespace App\Application\Services\Interfaces;

interface ProductServiceInterface
{
    public function getAllProducts();
    public function getProductById($id);
    public function createProduct(array $data);
    public function updateProduct(array $data, $id);
    public function deleteProduct($id);
    public function checkProductStock($productId, $quantity);

}