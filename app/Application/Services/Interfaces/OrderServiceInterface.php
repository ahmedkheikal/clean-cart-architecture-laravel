<?php

namespace App\Application\Services\Interfaces;

use App\Application\DTO\CartDTO;
use App\Domain\Entities\CartEntity;
use App\Infrastructure\Persistance\Models\Order;

interface OrderServiceInterface
{
    public function getOrderHistory();
    public function getOrderById($id);
    public function getOrderItems($orderId);
    public function createOrder(CartEntity $cart) : Order;
}