<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;

class SessionCartRepository implements CartRepositoryInterface
{
    public function getCart()
    {
        return session('cart', []);
    }

    public function addToCart($productId, $quantity)
    {
        $cart = $this->getCart();
        $cart[$productId] = $quantity;
        session(['cart' => $cart]);
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session(['cart' => $cart]);
    }

    public function clearCart()
    {
        session(['cart' => []]);
    }
}