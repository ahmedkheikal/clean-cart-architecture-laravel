<?php

namespace App\Infrastructure\Payment;

use App\Infrastructure\Payment\CashPayment;
use App\Infrastructure\Payment\Interfaces\PaymentMethodInterface;
use App\Infrastructure\Payment\StripePayment;

class PaymentFactory
{
    public static function createPaymentMethod(string $paymentMethod) : PaymentMethodInterface
    {
        return match ($paymentMethod) {
            'cash' => new CashPayment(),
            'stripe' => new StripePayment(),
            default => throw new \Exception('Invalid payment method'),
        };
    }
}   