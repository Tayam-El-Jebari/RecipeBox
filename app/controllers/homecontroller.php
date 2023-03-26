<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/productservice.php';


class HomeController extends Controller 
{
    private $productService;
    function __construct() {
        parent::__construct();
        $this->productService = new ProductService();
    }
    public function index()
    {
        $models = [
            "foodCategories" => $this->productService->getAllCategories(),
            "products" => $this->productService->getMostRecentFour()
        ];
        $this->displayView($models);
    }
}