<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/productservice.php';

class ProductsController extends Controller 
{
    private $productService;

    function __construct()
    {
        parent::__construct();
        $this->productService = new ProductService();
    }

    public function getMostRecentFour()
    {    
        return $this->productService->getMostRecentFour();
    }
    public function getAll()
    {    
        return $this->productService->getAll();
    }
    public function index()
    {
        $id = isset($_GET['id']);
        if($id)
        {
            $this->productDetailPage($id);
        }
        else{
            $models = [
                "products" => $this->productService->getAll()
            ];
            $this->displayView($models);
        }
    }
    public function productDetailPage($id){
        $models = [
            "product" => $this->productService->getOne($id)
        ];
        $this->displayView($models);
    }
}