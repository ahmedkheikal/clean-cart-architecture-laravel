<?php

namespace App\Application\Services;

use App\Infrastructure\Repositories\SessionCartRepository;
use App\Infrastructure\Repositories\DbCartRepository;
use App\Application\DTO\CartDTO;
use App\Application\DTO\CartItemDTO;
use App\Application\Services\Interfaces\CartServiceInterface;
use App\Application\Services\Interfaces\OrderServiceInterface;
use App\Application\Services\Interfaces\ProductServiceInterface;
use App\Infrastructure\Payment\Interfaces\PaymentInterface;
use App\Infrastructure\Repositories\Interfaces\CartRepositoryInterface;
use Exception;
use App\Domain\Entities\CartItemEntity;
use App\Domain\Entities\CartEntity;
use App\Domain\Cart\Services\CartValidationService;
class CartService implements CartServiceInterface
{
    /**
     * Summary of cart
     * @var CartEntity
     */
    protected $cart;
    protected $productService;
    protected $cartRepository;
    protected $orderService;
    protected $cartValidationService;
    public function __construct(
        ProductServiceInterface $productService,
        CartRepositoryInterface $cartRepository,
        OrderServiceInterface $orderService,
        CartValidationService $cartValidationService
    ) {
        $this->productService = $productService;
        $this->cartRepository = $cartRepository;
        $this->orderService = $orderService;
        $this->cartValidationService = $cartValidationService;
        $this->cart = $this->cartRepository->getCart();
    }
    public function addToCart(CartItemDTO $dto): CartDTO
    {
        $product = $this->productService->getProductById($dto->productId);
        $cartItemEntity = CartItemEntity::fromDTO($dto);
        $cartItemEntity->unitPrice = $product->price;
        $cartItemEntity->productName = $product->name;
        $cartItemEntity = $this->cartRepository->addToCart($cartItemEntity);
        $this->cart = $this->cartRepository->getCart();
        return CartDTO::fromEntity($this->cart);
    }
    public function removeFromCart(CartItemDTO $dto): CartDTO
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
    public function getCart(): CartDTO
    {
        $this->cart = $this->cartRepository->getCart();
        return CartDTO::fromEntity($this->cart);
    }
    public function checkout(PaymentInterface $paymentMethod): int
    {
        $this->cartValidationService->validateCart($this->cart);
        $order = $this->orderService->createOrder($this->cart);
        $paymentMethod->charge($order);
        $this->cartRepository->clearCart();
        return $order->id;
    }

    public function moveSessionCartToDatabaseCart()
    {
        $sessionCartRepo = app(SessionCartRepository::class);
        $databaseCartRepo = app(DbCartRepository::class);
        $sessionCart = $sessionCartRepo->getCart();
        foreach ($sessionCart->items as $item) {
            $databaseCartRepo->addToCart($item);
        }
    }
}