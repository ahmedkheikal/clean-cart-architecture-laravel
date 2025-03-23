<?php

namespace App\Application\Services\Interfaces;

use App\Application\DTO\CartDTO;
use App\Application\DTO\CartItemDTO;
use App\Infrastructure\Payment\Interfaces\PaymentInterface;
interface CartServiceInterface
 {
    public function addToCart(CartItemDTO $dto) : CartDTO;
    public function removeFromCart(CartItemDTO $dto);
    public function getCart();
    public function clearCart();
    public function checkout(PaymentInterface $paymentMethod);
 }