<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\CartEntity;
use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Domain\Entities\CartItemEntity;
class SessionCartRepository implements CartRepositoryInterface
{
    public function getCart() : CartEntity
    {
        $cart = session('cart', []);
        $items = [];
        foreach ($cart as $productId => $quantity) {
            $items[] = new CartItemEntity($productId, $quantity);
        }
        return new CartEntity($items, 0, count($items));
    }

    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        $cart->items[] = $cartItemEntity;
        session(['cart' => $cart]);
        return $cartItemEntity;
    }   

    public function removeFromCart(CartItemEntity $cartItemEntity) : bool
    {
        $cart = $this->getCart();
        $cart->items = array_filter($cart->items, function($item) use ($cartItemEntity) {
            return $item->productId !== $cartItemEntity->productId;
        });
        session(['cart' => $cart]);
        return true;
    }

    public function clearCart() : void
    {
        session(['cart' => []]);
    }
}
