<?php
require_once __DIR__ . '/../../services/productservice.php';

class AllProductsController
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $products = $this->productService->getAll();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function products()
    {
        
    }
}