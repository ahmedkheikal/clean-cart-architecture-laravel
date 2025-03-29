<?php

namespace App\Application\Services;

use App\Application\DTO\ProductDTO;
use App\Application\Services\Interfaces\ProductServiceInterface;
use App\Infrastructure\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products
     * 
     * @return ProductDTO[]
     */
    public function getAllProducts(): array
    {
        return $this->productRepository->getAllProducts();
    }
    
 
    public function getProductById($id): ProductDTO
    {
        return $this->productRepository->getProductById($id);
    }

    public function createProduct(array $data): ProductDTO
    {
        return $this->productRepository->createProduct($data);
    }
    
    
    public function updateProduct(array $data, $id)
    {
        return $this->productRepository->updateProduct($data, $id);
    }
    
    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);    
    }   

    public function checkProductStock($productId, $quantity)
    {
        $product = $this->getProductById($productId);
        if ($product->stock_balance >= $quantity) {
            return true;
        }
        return false;
    }

}