<?php

namespace App\Infrastructure\Payment\Interfaces;

use App\Infrastructure\Persistance\Models\Order;

interface PaymentInterface
{
    public function charge(Order $order);
    public function refund(Order $order);
    public function getPaymentStatus(Order $order);
    public function getPaymentDetails(Order $order);
}