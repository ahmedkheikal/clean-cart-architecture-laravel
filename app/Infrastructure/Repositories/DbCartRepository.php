<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Infrastructure\Persistance\Models\Cart;
use App\Domain\Entities\CartItemEntity;
class DbCartRepository implements CartRepositoryInterface
{
    public function getCart()
    {
        return Cart::where('user_id', auth()->user()->id)->first();
    }

    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        $cart->products()->attach($cartItemEntity->productId, ['quantity' => $cartItemEntity->quantity]);
        $cartItemEntity->id = $cart->products()->where('product_id', $cartItemEntity->productId)->first()->pivot->id;
        return $cartItemEntity;
    }

    public function removeFromCart(CartItemEntity $cartItemEntity)
    {
        $cart = $this->getCart();
        $cart->products()->detach($cartItemEntity->productId);
    }

    public function clearCart()
    {
        $cart = $this->getCart();
        $cart->products()->detach();
    }
}