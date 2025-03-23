<?php

namespace App\Application\Services\Interfaces;

use App\Infrastructure\Payment\Interfaces\PaymentInterface;
interface CartServiceInterface
 {
    public function addToCart($productId, $quantity);
    public function removeFromCart($productId);
    public function getCart();
    public function clearCart();
    public function checkout(PaymentInterface $paymentMethod);
 }