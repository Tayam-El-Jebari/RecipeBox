<?php
require_once __DIR__ . '/../../services/cartservice.php';

class GetOrderHistoryController
{
    private $productService;
    private $products;

    function __construct()
    {
        $this->productService = new CartService();
    }

    public function index()
    {
        header('Content-Type: application/json');
        try{
            if (isset($_SESSION['userID'])) {
                $this->products = $this->productService->getPaidOrders($_SESSION['userID']);
            }
            else{
                $this->products = "not logged in!";
            }
        }catch(Error $e){
            $this->products= $e->getMessage();
        }
        echo json_encode($this->products);
    }
}
