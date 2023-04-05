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
            $quantity = $item['quantity'];
            if ($quantity > 20) {
                $quantity = 20;
            }
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
}