<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Infrastructure\Persistance\Models\Cart;

class DbCartRepository implements CartRepositoryInterface
{
    public function getCart()
    {
        return Cart::where('user_id', auth()->user()->id)->first();
    }

    public function addToCart($productId, $quantity)
    {
        $cart = $this->getCart();
        $cart->products()->attach($productId, ['quantity' => $quantity]);
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        $cart->products()->detach($productId);
    }

    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->products()->detach();
    }
}