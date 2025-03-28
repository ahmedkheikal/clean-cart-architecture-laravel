<?php

namespace App\Infrastructure\Repositories\Interfaces;

use App\Domain\Entities\CartEntity;
use App\Domain\Entities\CartItemEntity;

interface CartRepositoryInterface
{
    public function getCart() : CartEntity; 
    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity;
    public function removeFromCart(CartItemEntity $cartItemEntity) : bool;
    public function clearCart() : void;
}
