<?php

namespace App\Domain\Cart\Services;

use App\Application\Services\Interfaces\ProductServiceInterface;
use App\Domain\Cart\Exceptions\OutOfStockException;
use App\Domain\Entities\CartEntity;

class CartValidationService
{
    protected $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function validateCart(CartEntity $cart) : bool
    {
        $validationErrors = [];
        foreach ($cart->items as $item) {
            $this->productService->checkProductStock($item->productId, $item->quantity);
            if (!$this->productService->checkProductStock($item->productId, $item->quantity)) {
                $validationErrors[] = $item->productId;
            }
        }
        if (count($validationErrors) > 0) {
            throw new OutOfStockException('Some products are out of stock');
        }
        return true;
    }
}