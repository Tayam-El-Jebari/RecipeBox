<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/productservice.php';

class CartController extends Controller
{
    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index()
    {
        $models = [
            "products" => $this->productService->getAll(),
        ];
        $this->displayView($models);
    }
}
