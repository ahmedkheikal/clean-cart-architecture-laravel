<?php

namespace App\Application\Services\Interfaces;

use App\Application\DTO\CartDTO;
use App\Application\DTO\CartItemDTO;
use App\Infrastructure\Payment\Interfaces\PaymentMethodInterface;
interface CartServiceInterface
 {
    public function addToCart(CartItemDTO $dto) : CartDTO;
    public function removeFromCart(CartItemDTO $dto);
    public function getCart() : CartDTO;
    public function clearCart();
    public function checkout(PaymentMethodInterface $paymentMethod);
    public function moveSessionCartToDatabaseCart();
 }