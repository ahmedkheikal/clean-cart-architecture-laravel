<?php

namespace App\Application\Services\Interfaces;

interface OrderServiceInterface
{
    public function getOrderHistory();
    public function getOrderById($id);
    public function getOrderItems($orderId);
    public function getOrderTotal($orderId);
    public function getOrderStatus($orderId);
    public function getOrderDate($orderId);
    public function getOrderCustomer($orderId);
    public function createOrder(Cart $cart);
}