<?php

namespace App\Application\Services;

use App\Application\DTO\CartDTO;
use App\Application\DTO\CartItemDTO;
use App\Application\Services\Interfaces\CartServiceInterface;
use App\Application\Services\Interfaces\OrderServiceInterface;
use App\Application\Services\Interfaces\ProductServiceInterface;
use App\Infrastructure\Payment\Interfaces\PaymentInterface;
use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use Exception;
use App\Domain\Entities\CartItemEntity;
class CartService implements CartServiceInterface
{
    protected $cart;
    protected $productService;
    protected $cartRepository;
    protected $orderService;
    public function __construct(
        ProductServiceInterface $productService,
        CartRepositoryInterface $cartRepository,
        OrderServiceInterface $orderService
    ) {
        $this->productService = $productService;
        $this->cartRepository = $cartRepository;
        $this->orderService = $orderService;
        $this->cart = $this->cartRepository->getCart();
    }
    public function addToCart(CartItemDTO $dto) : CartDTO
    {
        $cartItemEntity = CartItemEntity::fromDTO($dto);
        $cartItemEntity = $this->cartRepository->addToCart($cartItemEntity);
        $this->cart = $this->cartRepository->getCart();
        return CartDTO::fromEntity($this->cart);
    }
    public function removeFromCart(CartItemDTO $dto) : CartDTO
    {
        $cartItemEntity = CartItemEntity::fromDTO($dto);
        $this->cartRepository->removeFromCart($cartItemEntity);
        $this->cart = $this->cartRepository->getCart();
        return CartDTO::fromEntity($this->cart);
    }
    public function clearCart()
    {
        $this->cartRepository->clearCart();
        $this->cart = $this->cartRepository->getCart();
    }
    public function getCart()
    {
        return $this->cart;
    }
    public function checkout(PaymentInterface $paymentMethod)
    {
        // move validation to match clean architecture (domain layer)
        $validationErrors = [];
        foreach ($this->cart->products as $product) {
            $this->productService->checkProductStock($product->id, $product->quantity);
            if (!$this->productService->checkProductStock($product->id, $product->quantity)) {
                $validationErrors[] = $product->id;
            }
        }
        if (count($validationErrors) > 0) {
            throw new Exception('Some products are out of stock');
        }
        $order = $this->orderService->createOrder($this->cart);
        $paymentMethod->charge($order);
        $this->cartRepository->clearCart();
        return $order->id;
    }
}