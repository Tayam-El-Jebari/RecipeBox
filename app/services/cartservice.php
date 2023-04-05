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

    public function getCart($cart)
    {
        $cartItems = [];

        foreach ($cart as $item) {
            $quantity = $this->updateQuantity($item['quantity']);
            if ($quantity > 0) {
                $productId = $item['id'];
                $order = new Order($this->repository->getOne($productId), $quantity);
                if ($order->getProduct()->getProductId() !== null) {
                    $cartItems[] = $order;
                }
            }
        }

        return $cartItems;
    }
    public function storeUserCart($userId, $cart)
    {
       
        foreach ($cart as $item) {
            $quantity = $this->updateQuantity($item['quantity']);
            //prevents storage of items with quantity of 0 or below
            if( $quantity)
            {
                if ($this->repository->checkIfCartItemExists($userId, $item)) {
                    $this->repository->updateUserCartItem($userId, $item);
                } else {
                    $this->repository->storeUserCartItem($userId, $item);
                }
            } 
        }
    }
    private function updateQuantity($quantity){
        if ($quantity > 20) {
            $quantity = 20;
        }
        return $quantity;
    }
}
