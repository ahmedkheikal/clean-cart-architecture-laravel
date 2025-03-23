<?php

namespace App\Http\Controllers;

use App\Application\Services\Interfaces\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Application\DTO\CartItemDTO;
use Illuminate\Support\Facades\Validator;
class CartController extends Controller
{
    private $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the current cart contents.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json([
            'data' => $this->cartService->getCart()
        ]);
    }

    /**
     * Add an item to the current cart.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addItem(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:0.01',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $itemDto = CartItemDTO::fromRequest($request->all());
        $cartDto = $this->cartService->addToCart($itemDto);
        return response()->json([
            'data' => $cartDto,
            'message' => 'Item added to cart successfully'
        ], 201);
    }

    /**
     * Process the current cart checkout.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkout(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $paymentMethod = $request->payment_method;
        $this->cartService->checkout($paymentMethod);
        return response()->json([
            'data' => $this->cartService->getCart(),
            'message' => 'Checkout processed successfully'
        ], 201);
    }
} 