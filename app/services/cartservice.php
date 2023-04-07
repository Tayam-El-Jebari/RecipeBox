<?php
require_once __DIR__ . '/../repositories/productrepository.php';
require_once __DIR__ . '/../models/order.php';
class CartService
{
    private $repository;
    function __construct()
    {
        $this->repository = new ProductRepository();
    }

    public function getCart($cart, $id)
    {
        $cartItems = [];
        $notFoundCount = 0;

        foreach ($cart as $item) {
            $quantity = $this->updateQuantity($item['quantity']);
            if ($quantity > 0) {
                $productId = $item['id'];
                $order = new Order($this->repository->getOneProduct($productId), $quantity);
                if ($order->getProduct()->getProductId() !== null) {
                    $cartItems[] = $order;
                } else {
                    $notFoundCount++;
                }
            }
        }
        if($notFoundCount > 0){
            $message = "{$notFoundCount} of the cart items are no longer being sold or are not available at the moment and have not been added to the cart." ;
        }else{
            $message = "";
        }

        return ['items' => $cartItems, 'message' => $message];
    }
    public function processPaymentOfCart($userId, $cart)
    {
        foreach ($cart as $item) {
            $quantity = $this->updateQuantity($item['quantity']);
            $cartItem = new Order(new MealProduct, $quantity);
            $cartItem->getProduct()->setProductId($item["id"]);
            //prevents storage of items with quantity of 0 or below
            if ($quantity > 0) {
                 $this->repository->processPaymentCartItem($userId, $cartItem);
            }
        }
    }
    public function storeUserCart($userId, $cart)
    {
        foreach ($cart as $item) {
            $quantity = $this->updateQuantity($item['quantity']);
            $cartItem = new Order(new MealProduct, $quantity);
            $cartItem->getProduct()->setProductId($item["id"]);
            //prevents storage of items with quantity of 0 or below
            if ($quantity > 0) {
                if ($this->repository->checkIfCartItemExists($userId, $cartItem)) {
                    $this->repository->updateUserCartItem($userId, $cartItem);
                } else 
                {
                    $this->repository->storeUserCartItem($userId, $cartItem);
                }
            }
        }
    }
    public function getMostRecentPaidOrders($userId){
        try{
            return $this->repository->getMostRecentPaidOrders($userId);
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getPaidOrders($userId){
        try{
            return $this->repository->getPaidOrders($userId);
        } catch (Exception $e) {
            throw $e;
        }
    }
    private function updateQuantity($quantity)
    {
        if ($quantity > 20) {
            $quantity = 20;
        }
        return $quantity;
    }
}
