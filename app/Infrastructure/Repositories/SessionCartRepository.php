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
        $items = $cart['items'] ?? [];
        $totalPrice = $cart['totalPrice'] ?? 0;
        $totalQuantity = $cart['totalQuantity'] ?? 0;
        return new CartEntity($items, $totalPrice, $totalQuantity);

    }

    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        $cartItem = array_filter($cart->items, callback: function($item) use ($cartItemEntity) {
            return $item->productId === $cartItemEntity->productId;
        });
        $cartItem = array_pop($cartItem);
        if ($cartItem) {
            $cartItem->quantity += $cartItemEntity->quantity;
        } else {
            $cart->items[] = $cartItemEntity;
        }
        session(['cart' => $cart->toArray()]);
        return $cartItemEntity;
    }   

    public function removeFromCart(CartItemEntity $cartItemEntity) : bool
    {
        $cart = $this->getCart();
        $cart->items = array_filter($cart->items, function($item) use ($cartItemEntity) {
            return $item->productId !== $cartItemEntity->productId;
        });
        session(['cart' => $cart->toArray()]);
        return true;
    }

    public function clearCart() : void
    {
        session(['cart' => []]);
    }
}
