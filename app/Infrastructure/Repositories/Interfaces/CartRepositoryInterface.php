<?php

namespace App\Infrastructure\Repositories\Interfaces;

interface CartRepositoryInterface
{
    public function getCart();
    public function addToCart($productId, $quantity);
    public function removeFromCart($productId);
    public function clearCart();
}
