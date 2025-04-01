<?php

namespace App\Infrastructure\Payment;

use App\Infrastructure\Payment\Interfaces\PaymentMethodInterface;
use App\Infrastructure\Persistance\Models\Order;
use App\Infrastructure\Persistance\Models\Payment;
use Stripe\StripeClient;

class StripePayment implements PaymentMethodInterface
{
    public function charge(Order $order)
    {
    // use stripe sdk to charge the order
    // return the payment record
    $payment = new Payment();
    $payment->order_id = $order->id;
    $payment->amount = $order->total_amount;
    $payment->status = 'pending';
    $payment->save();
    // use stripe sdk to charge the order
    $stripe = new StripeClient(config('stripe.secret_key'));
    $stripe->paymentIntents->create([
        'amount' => $order->total_amount * 100,
        'currency' => 'usd',
        'payment_method' => 'pm_1234567890',
        'confirm' => true,
    ]);
    $payment->status = 'succeeded';
    $payment->save();
    return $payment;

    }
    public function refund(Order $order)
    {
        // use stripe sdk to refund the order
        $payment = Payment::where('order_id', $order->id)->first();
        $stripe = new StripeClient(config('stripe.secret_key'));
        $stripe->refunds->create([
            'amount' => $order->total_amount * 100,
            'currency' => 'usd',
            'payment_intent' =>  $payment->transaction_id,
        ]);
        $payment->status = 'refunded';
        $payment->save();
        return $payment;
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