<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Domain\Entities\CartItemEntity;
class SessionCartRepository implements CartRepositoryInterface
{
    public function getCart()
    {
        return session('cart', []);
    }

    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        $cart[$cartItemEntity->productId] = $cartItemEntity->quantity;
        session(['cart' => $cart]);
        return $cartItemEntity;
    }

    public function removeFromCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        unset($cart[$cartItemEntity->productId]);
        session(['cart' => $cart]);
        return $cartItemEntity;
    }

    public function clearCart()
    {
        session(['cart' => []]);
    }
}