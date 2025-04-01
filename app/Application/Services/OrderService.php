<?php

namespace App\Application\Services;

use App\Application\Services\Interfaces\OrderServiceInterface;
use App\Domain\Entities\CartEntity;
use App\Infrastructure\Persistance\Models\Order;
use App\Infrastructure\Persistance\Models\OrderItem;


class OrderService implements OrderServiceInterface
{
    public function createOrder(CartEntity $cart) : Order    
    {
        $cartInsert = $cart;
        $cartInsert->id = null;
        $cartInsert = $cartInsert->toArray();
        unset($cartInsert['items']);
        $cartInsert['user_id'] = auth()->user()->id;
        $order = Order::create($cartInsert);
        // items 
        foreach ($cart->items as $item) {
            $orderItem = OrderItem::create([
                'product_id' => $item->productId,
                'quantity' => $item->quantity,
                'unit_price' => $item->unitPrice,
                'total_price' => $item->unitPrice * $item->quantity
            ]);
            $order->items()->attach($orderItem);
        }
        return $order;
    }

    public function getOrderHistory()
    {
        return Order::all();
    }

    public function getOrderById($id)
    {
        return Order::find($id);
    }

    public function getOrderItems($orderId)
    {
        return Order::find($orderId)->items;
    }

    public function getOrderTotal($orderId)
    {
        return Order::find($orderId)->total;
    }

    public function getOrderStatus($orderId)
    {
        return Order::find($orderId)->status;
    }

    public function getOrderDate($orderId)
    {
        return Order::find($orderId)->created_at;
    }

    public function getOrderCustomer($orderId)
    {
        return Order::find($orderId)->customer;
    }
}   