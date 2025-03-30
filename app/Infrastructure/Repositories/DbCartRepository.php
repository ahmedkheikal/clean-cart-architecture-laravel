<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use App\Infrastructure\Persistance\Models\Cart;
use App\Domain\Entities\CartItemEntity;
use App\Domain\Entities\CartEntity;
class DbCartRepository implements CartRepositoryInterface
{
    public function getCart() : CartEntity
    {
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => auth()->user()->id]);
        }
        return CartEntity::fromModel($cart);
    }

    public function addToCart(CartItemEntity $cartItemEntity) : CartItemEntity
    {
        $cart = $this->getCart();
        $cart = Cart::find($cart->id);
        $cartItem = $cart->products()->where('product_id', $cartItemEntity->productId)->first();
        if ($cartItem) {
            $cartItem->pivot->quantity += $cartItemEntity->quantity;
            $cartItem->pivot->unit_price = $cartItemEntity->unitPrice;
            $cartItem->pivot->save();
        } else {
            $cart->products()->attach($cartItemEntity->productId, [
                'quantity' => $cartItemEntity->quantity,
                'unit_price' => $cartItemEntity->unitPrice
            ]);
        }
        $cartItemEntity->id = $cart->products()->where('product_id', $cartItemEntity->productId)->first()->pivot->id;
        return $cartItemEntity;
    }

    public function removeFromCart(CartItemEntity $cartItemEntity) : bool
    {
        $cart = $this->getCart();
        $cart = Cart::find($cart->id);
        $cartItemId = $cart->products()->where('product_id', $cartItemEntity->productId)->first()->pivot->id;
        $cart->products()->detach($cartItemId);
        return true;
    }

    public function clearCart() : void
    {
        $cart = $this->getCart();
        $cart = Cart::find($cart->id);
        $cart->products()->detach();
    }
}