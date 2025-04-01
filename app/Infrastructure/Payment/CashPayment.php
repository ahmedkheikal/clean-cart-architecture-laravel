<?php

namespace App\Infrastructure\Payment;

use App\Infrastructure\Payment\Interfaces\PaymentMethodInterface;
use App\Infrastructure\Persistance\Models\Order;
use App\Infrastructure\Persistance\Models\Payment;

class CashPayment implements PaymentMethodInterface
{
    public function charge(Order $order)
    {
        // create a payment record with status pending and amount of the order
        // return the payment record
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->amount = $order->total_amount;
        $payment->status = 'pending';
        $payment->payment_type = 'payment';
        $payment->save();
        return $payment;
    }
    public function refund(Order $order)
    {
        // create a refund record with status pending and amount of the order
        // return the refund record
        $refund = new Payment();
        $refund->order_id = $order->id;
        $refund->amount = $order->total_amount;
        $refund->status = 'pending';
        $refund->payment_type = 'refund';
        $refund->save();
        return $refund;
    }
    public function getPaymentStatus(Order $order)
    {
        $payment = Payment::where('order_id', $order->id)->first();
        return $payment->status;
    }
    public function getPaymentDetails(Order $order)
    {
        $payment = Payment::where('order_id', $order->id)->first();
        return $payment;
    }
}   