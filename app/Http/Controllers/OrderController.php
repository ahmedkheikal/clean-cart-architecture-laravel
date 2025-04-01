<?php

namespace App\Http\Controllers;

use App\Application\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->getOrderHistory();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return response()->json($order);
    }
}
