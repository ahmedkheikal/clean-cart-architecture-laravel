<?php

namespace App\Infrastructure\Repositories\Interfaces;

use App\Domain\Entities\CartItemEntity;

interface CartRepositoryInterface
{
    public function getCart();
    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity;
    public function removeFromCart(CartItemEntity $cartItemEntity);
    public function clearCart();
}
